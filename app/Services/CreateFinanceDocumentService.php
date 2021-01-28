<?php


namespace App\Services;

use App\Models\FinanceDocument;
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
        $tableRow = $createFinanceDocumentTableRowService->fill($doc, $med, $characteristic->id);
        if (!$tableRow) return response(null,500);

        // добавление значения id характеристики в таблицу Цены характеристик
        $cp->update(['characteristic_id' => $characteristic->id]);

        return $tableRow;
    }



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
}
