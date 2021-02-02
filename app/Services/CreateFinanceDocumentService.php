<?php


namespace App\Services;

use App\Models\FinanceDocument;
use App\Repositories\FinanceDocumentsRepository;
use App\Repositories\FinanceDocumentTableRowsRepository;
use Carbon\Carbon;

class CreateFinanceDocumentService
{

    public function makeIncome($data)
    {
        $rest = substr($data['date'], 0, -3);
        $date = Carbon::createFromTimestamp($rest, 'Europe/Moscow')->toDateTimeString();

        return (new FinanceDocument())->create(['agent_id' => $data['agent_id'],
            'comment' => $data['comment'],
            'date' =>  $date,
            'is_set' => true,
            'doc_type_id' => 1,
            'storage_id'=> $data['storage_id']
        ]);
    }

    // заполнение сущностей данными
    public function fillData($doc, $med)
    {
        $createCharacteristicPriceService= app(CreateCharacteristicPriceService::class);
        $createCharacteristicService = app(CreateCharacteristicService::class);
        $createFinanceDocumentTableRowService = app(CreateFinanceDocumentTableRowService::class);

        // создание цены для характеристики со значением характеристики по умолчанию
        $cp = $createCharacteristicPriceService->make($med);
        if (!$cp) return response(null,500);

        // добавление новой характеристики
        $characteristic = $createCharacteristicService->make(['characteristic_price_id' => $cp->id] +$med);
        if (!$characteristic) return response(null,500);

        // добавление новой строки в документ
        $tableRow = $createFinanceDocumentTableRowService->fillTableRow($doc, $med, $characteristic->id);
        if (!$tableRow) return response(null,500);

        // добавление значения id характеристики в таблицу Цены характеристик
        $cp->update(['characteristic_id' => $characteristic->id]);

        return $tableRow;
    }

    // метод сохранения приходного документа
    public function createIncome($data, $meds)
    {
        // добавление нового документа
        $doc = $this->makeIncome($data);

        if($doc){
            // циклический проход по массиву медикаментов
            foreach ($meds as $med) {

                $result = $this->fillData($doc, $med);
                if (!$result) return response(null,500);

            } // foreach
        }
        return $doc;
    }

    // метод проведения документа
    public function pushIncome($doc_id)
    {
        $financeDocumentTableRowsRepository = app(FinanceDocumentTableRowsRepository::class);
        $financeDocumentsRepository = app(FinanceDocumentsRepository::class);
        $createWareConnectionService = app(CreateWareConnectionService::class);

        // получение документа
        $doc = $financeDocumentsRepository->find($doc_id);

        // получение строк документа
        $rows = $financeDocumentTableRowsRepository->forPush($doc_id);

        if($rows){
            // циклический проход по массиву строк документа
            foreach ($rows as $row) {

                $result = $createWareConnectionService->pushWareConnection($row, $doc->storage_id);
                if (!$result) return response(null,500);

            } // foreach
        }
        return $doc;
    }
}
