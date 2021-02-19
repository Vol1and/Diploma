<?php


namespace App\Services;


use App\Models\StorageDocument;
use App\Repositories\CharacteristicPricesRepository;
use App\Repositories\CharacteristicsRepository;
use App\Repositories\FinanceDocumentTableRowsRepository;
use App\Repositories\StorageDocumentTableRowsRepository;
use Carbon\Carbon;

class CreateStorageDocumentService
{
    public function makeStorageDoc($data)
    {

        $rest = substr($data['date'], 0, -3);
        $date = Carbon::createFromTimestamp($rest, 'Europe/Moscow')->toDateTimeString();

        if($data['doc_type_id'] == 3) {
            // заполнение сущности документа
            $doc = (new StorageDocument())
                ->create([
                'comment' => $data['comment'],
                'date' =>  $date,
                'is_set' => false,
                'doc_type_id' => 3,
                'source_storage_id'=> $data['source_storage_id'],
                'destination_storage_id' => $data['destination_storage_id']
            ]);
        }
        return $doc;
    }

    // заполнение сущностей данными
    public function fillData($doc, $med)
    {

        $storageDocumentTableRowsRepository = app(StorageDocumentTableRowsRepository::class);
        $characteristicsRepository= app(CharacteristicsRepository::class);
        $createStorageDocumentTableRowService = app(CreateStorageDocumentTableRowService::class);


        // получение строки таблицы для обновления
        $tableRow = $storageDocumentTableRowsRepository->find($med['id']);

        // обновление строки документа если есть, иначе создание новой
        if ($tableRow) $tableRow->update($med);
        else $tableRow = $createStorageDocumentTableRowService->fillTableRow($doc, $med, $med['characteristic_id']);

        if (!$tableRow) return response(['error' => "Строка документа не была создана"], 500);
        return $tableRow;
    }

    // метод сохранения приходного документа
    public function createStorageDoc($data, $meds)
    {
        // добавление нового документа
        $doc = $this->makeStorageDoc($data);


        if($doc){
            // циклический проход по массиву медикаментов
            foreach ($meds as $row) {
                $result = $this->fillData($doc, $row);
                if (!$result) return response(null,500);
            } // foreach

        }
        return $doc;
    }

    public function pushStorageDoc($data)
    {
        // TODO: СДЕЛАТЬ!
        return true;
    }
}
