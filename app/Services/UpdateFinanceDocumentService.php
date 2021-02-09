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
    public function updateIncome($data, $deleted, $updated, $id)
    {
        $financeDocumentsRepository = app(FinanceDocumentsRepository::class);
        $financeDocumentTableRowsRepository = app(FinanceDocumentTableRowsRepository::class);
        $createFinanceDocumentService = app(CreateFinanceDocumentService::class);

        // поиск Документа найден по id
        $doc = $financeDocumentsRepository->find($id);
        if (empty($doc)) return response(null,400);

        // обновление информации о документе
        $doc->update(['agent_id' => $data['agent_id'],'comment' => $data['comment'],'date' => new Carbon($data['date']) ,'is_set' => true, 'doc_type_id' => 1, 'storage_id'=> $data['storage_id'] ]);


        // если есть строки для удаления
        if ($deleted) {
            foreach ($deleted as $del_row){

                // получение строки таблицы для удаления
                $tableRow = $financeDocumentTableRowsRepository->find($del_row);
                if($tableRow){
                    $result = $tableRow->delete();
                    if (!$result)
                        return response(['error' => "Ошибка удаления"], 500);
                }
                // TODO: доработать логику удаления всех сущностей (сейчас только строки документа)

            }
        }

        // циклический проход по массиву медикаментов
        foreach ($updated as $row) {

            // строка документа до внесения изменений
            $base_row = $financeDocumentTableRowsRepository->find($row['id']);

            // если строка не новая
            if ($base_row){

                // если по строке изменилась номенклатура
                if($base_row->characteristic->nomenclature_id != $row['nomenclature_id']){

                    // проверка на ошибочную характеристику
                    if ($base_row->characteristic_id == $row['characteristic_id']) return response(null,400);
                }
            }

            // универсальный СУПЕР-МЕГА метод по добавлению/обновлению строк
            //TODO: если работает - раздробить его и упростить, иначе чинить
            $createFinanceDocumentService->fillData($doc, $row);
        }

        return $doc;
    }
}
