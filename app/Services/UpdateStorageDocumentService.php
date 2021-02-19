<?php


namespace App\Services;


use App\Repositories\StorageDocumentsRepository;
use App\Repositories\StorageDocumentTableRowsRepository;
use Carbon\Carbon;

class UpdateStorageDocumentService
{
    public function updateCancellation($data, $deleted, $updated, $id)
    {
        $storageDocumentsRepository = app(StorageDocumentsRepository::class);
        $storageDocumentTableRowsRepository = app(StorageDocumentTableRowsRepository::class);
        $createStorageDocumentService = app(CreateStorageDocumentService::class);

        // поиск Документа найден по id
        $doc = $storageDocumentsRepository->find($id);
        if (empty($doc)) return response(null, 400);

        // обновление информации о документе
        $doc->update(['source_storage_id' => $data['source_storage_id'], 'comment' => $data['comment'], 'date' => new Carbon($data['date']),
            'is_set' => false, 'doc_type_id' => $data['doc_type_id'], 'destination_storage_id' => $data['destination_storage_id'],
            'doc_sum' => $data['doc_sum']]);


        // если есть строки для удаления
        if ($deleted) {
            foreach ($deleted as $del_row) {

                // получение строки таблицы для удаления
                $tableRow = $storageDocumentTableRowsRepository->find($del_row);
                if ($tableRow) {
                    $result = $tableRow->delete();
                    if (!$result)
                        return response(['error' => "Ошибка удаления"], 500);
                }
            }
        }


        // циклический проход по массиву медикаментов
        foreach ($updated as $row) {

            // строка документа до внесения изменений
            $base_row = $storageDocumentTableRowsRepository->find($row['id']);

            // если строка не новая
            if ($base_row) {

                // если по строке изменилась номенклатура
                if ($base_row->characteristic->nomenclature_id != $row['nomenclature_id']) {

                    // проверка на ошибочную характеристику
                    if ($base_row->characteristic_id == $row['characteristic_id']) return response(null, 400);
                }
            }

            // универсальный СУПЕР-МЕГА метод по добавлению/обновлению строк
            //TODO: если работает - раздробить его и упростить, иначе чинить
            $createStorageDocumentService->fillData($doc, $row);
        }

        return $doc;
    }
}
