<?php


namespace App\Services;

use App\Models\FinanceDocument;
use App\Repositories\CharacteristicPricesRepository;
use App\Repositories\CharacteristicsRepository;
use App\Repositories\FinanceDocumentsRepository;
use App\Repositories\FinanceDocumentTableRowsRepository;
use Carbon\Carbon;

class CreateFinanceDocumentService
{

    public function makeFinanceDoc($data)
    {
        $createButchNumberConnectionService = app(CreateButchNumberConnectionService::class);

        $rest = substr($data['date'], 0, -3);
        $date = Carbon::createFromTimestamp($rest, 'Europe/Moscow')->toDateTimeString();

        // заполнение сущности документа
        $doc = (new FinanceDocument())->create(['agent_id' => $data['agent_id'],
            'comment' => $data['comment'],
            'date' =>  $date,
            'is_set' => false,
            'doc_type_id' => $data['doc_type_id'],
            'storage_id'=> $data['storage_id'],
            'doc_sum' => $data['doc_sum']
        ]);

        // создание номера партии по номеру документа если это получение
        if($doc->doc_type_id == 1) $createButchNumberConnectionService->make(['butch_number' => $doc->id]);

        return $doc;
    }

    // заполнение сущностей данными
    public function fillData($doc, $med)
    {
        $createCharacteristicPriceService= app(CreateCharacteristicPriceService::class);
        $financeDocumentTableRowsRepository = app(FinanceDocumentTableRowsRepository::class);
        $characteristicPricesRepository= app(CharacteristicPricesRepository::class);
        $characteristicsRepository= app(CharacteristicsRepository::class);
        $createFinanceDocumentTableRowService = app(CreateFinanceDocumentTableRowService::class);

        // поиск выбранной характеристики для выбранной номенклатуры в БД по id
        $characteristic = $characteristicsRepository->findById($med['nomenclature_id'],$med['characteristic_id']);

        // получение строки таблицы для обновления
        $tableRow = $financeDocumentTableRowsRepository->find($med['id']);

        // если нашлась
        if ($characteristic) {

            // проверка соответствия цены характеристики из респонса к цене в БД
            $checkPrice = $characteristicPricesRepository->getLatestPriceForCharacteristic($characteristic->id);

            // если назначается первая цена - устанавливается цена из строки документа
            if ($checkPrice->price != $med['sell_price']) {

                // создаётся новая цена, с привязкой к характеристике из БД, переоценивая остатки
                $cp = $createCharacteristicPriceService->makeUpdate($med);
                if (!$cp) return response(['error' => "Сущность цены характеристики не добавлена"], 500);

                // в характеристике обновляется id цены
                $characteristic->update(['characteristic_price_id' => $cp->id]);
            }

            // обновление строки документа если есть, иначе создание новой
            if ($tableRow) $tableRow->update(['price' => $med['income_price']] + $med);
            else {
                $tableRow = $createFinanceDocumentTableRowService->fillTableRow($doc, $med, $med['characteristic_id']);
                if (!$tableRow) return response(['error' => "Строка документа не была создана"], 500);
            }
        } else return response(['error' => "Характеристика не была выбрана для строки документа"], 500);

        return $tableRow;
    }


    // метод сохранения приходного документа
    public function createFinanceDoc($data, $meds)
    {
        // добавление нового документа
        $doc = $this->makeFinanceDoc($data);

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
    public function pushFinanceDoc($doc_id)
    {
        $financeDocumentTableRowsRepository = app(FinanceDocumentTableRowsRepository::class);
        $financeDocumentsRepository = app(FinanceDocumentsRepository::class);
        $createWareConnectionService = app(CreateWareConnectionService::class);

        // получение документа
        $doc = $financeDocumentsRepository->find($doc_id);

        // получение строк документа
        $rows = $financeDocumentTableRowsRepository->forPush($doc_id);

        if($rows)
        {
            if($doc->doc_type_id > 1){
                // циклический проход по массиву строк документа
                foreach ($rows as $row) {

                    //TODO: здесь может вылезти ошибкаа!!!

                    // попытка изменить знак в расходе
                    $row->change = -$row->change;

                    $result = $createWareConnectionService->pushWareConnection($row, $doc);
                    if (!$result) return response(null,500);

                } // foreach
            } else {
                // циклический проход по массиву строк документа
                foreach ($rows as $row) {

                    $result = $createWareConnectionService->pushWareConnection($row, $doc);
                    if (!$result) return response(null,500);

                } // foreach
            }
        }
        return $doc;
    }
}
