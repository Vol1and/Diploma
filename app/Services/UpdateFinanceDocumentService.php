<?php


namespace App\Services;


use App\Models\CharacteristicPrice;
use App\Repositories\CharacteristicPricesRepository;
use App\Repositories\CharacteristicsRepository;
use App\Repositories\FinanceDocumentsRepository;
use App\Repositories\FinanceDocumentTableRowsRepository;
use App\Repositories\WareConnectionsRepository;
use Carbon\Carbon;

class UpdateFinanceDocumentService
{
    public function updateIncome($data, $meds, $id)
    {
        $financeDocumentsRepository = app(FinanceDocumentsRepository::class);
        $financeDocumentTableRowsRepository = app(FinanceDocumentTableRowsRepository::class);
        $characteristicsRepository = app(CharacteristicsRepository::class);
        $characteristicPricesRepository = app(CharacteristicPricesRepository::class);
        $wareConnectionsRepository = app(WareConnectionsRepository::class);
        $createFinanceDocumentService = app(CreateFinanceDocumentService::class);
        $createCharacteristicPriceService = app(CreateCharacteristicPriceService::class);

        // поиск Документа найден по id
        $doc = $financeDocumentsRepository->find($id);
        if (empty($doc)) return response(null,204);

        // обновление информации о документе
        $doc->update(['agent_id' => $data['agent_id'],'comment' => $data['comment'],'date' => new Carbon($data['date']) ,'is_set' => true, 'doc_type_id' => 1, 'storage_id'=> $data['storage_id'] ]);

        // циклический проход по массиву медикаментов
        foreach ($meds as $med) {

            // получение изменяемой характеристики
            $characteristic = $characteristicsRepository->find($med['characteristic_id']);

            // если не найдена характеристика - создаётся новая
            if (empty($characteristic)) {
                $result =  $createFinanceDocumentService->fillData($doc, $med);
                if (!$result) return response(null,500);

                continue;
            } // if

            // получение сущности цена характеристики
            $cp = $characteristicPricesRepository->find($med['characteristic_price_id']);
            if (empty($cp)) return response(null,204);

            // внесение изменений в характеристику
            $characteristic->update($med);

            // если цена - не та что была раньше
            if($cp->price != $med['sell_price']) {
                // создание новой цены для характеристики
                $newCp = $createCharacteristicPriceService->make(['characteristic_id' => $characteristic->id] + $med);
                if (!$newCp) return response(null,500);

                // обновление цены в характеристике
                $characteristic->update(['characteristic_price_id' => $newCp->id]);
            }

            // поиск строки
            $tableRow = $financeDocumentTableRowsRepository->find($med['id']);
            if (empty($tableRow)) return response(null,204);

            // обновление проводки документа
            $tableRow->update(['count' => $med['count'], 'price' => $med['income_price']]);

            $wc = $wareConnectionsRepository->find($tableRow->wareConnection->id);
            if (empty($wc)) return response(null,204);

            //обновление проводки для регистр накопления
            $wc->update(['change' => $med['count']]);

        } // foreach
        return $doc;
    }
}
