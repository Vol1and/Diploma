<?php


namespace App\Services;


use App\Models\StorageDocument;
use App\Repositories\CharacteristicsRepository;
use App\Repositories\StorageDocumentsRepository;
use App\Repositories\StorageDocumentTableRowsRepository;
use Carbon\Carbon;

class CreateStorageDocumentService
{
    public function makeStorageDoc($data)
    {

        $rest = substr($data['date'], 0, -3);
        $date = Carbon::createFromTimestamp($rest, 'Europe/Moscow')->toDateTimeString();

        if (!empty($data['destination_storage_id'])) $destination_storage_id = $data['destination_storage_id'];
        else $destination_storage_id = $data['source_storage_id'];

        // заполнение сущности документа
        $doc = (new StorageDocument())
            ->create([
            'comment' => $data['comment'],
            'date' =>  $date,
            'is_set' => false,
            'doc_type_id' => 3,
            'source_storage_id'=> $data['source_storage_id'],
            'destination_storage_id' => $destination_storage_id
        ]);

        return $doc;
    }

    // заполнение сущностей данными
    public function fillData($doc, $med)
    {

        $storageDocumentTableRowsRepository = app(StorageDocumentTableRowsRepository::class);
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

    public function pushStorageDoc($doc_id)
    {
        $storageDocumentsRepository = app(StorageDocumentsRepository::class);
        $storageDocumentTableRowsRepository = app(StorageDocumentTableRowsRepository::class);
        $createStorageDocumentTableRowService = app(CreateStorageDocumentTableRowService::class);
        $createWareConnectionService = app(CreateWareConnectionService::class);
        $characteristicsRepository = app(CharacteristicsRepository::class);

        // получение документа
        $doc = $storageDocumentsRepository->find($doc_id);

        if ($doc['is_set'] == 1) return $doc;

        // получение строк документа
        $doc_rows = $storageDocumentTableRowsRepository->forPush($doc_id);

        foreach($doc_rows as $row) {

            $row_cancel = $row['count'];
            $is_first_row = true;

            // партии с количествами продаваемого медикамента
            $wares = $characteristicsRepository->getCharacteristicWareButches($row['characteristic_id'], $doc->source_storage_id);


            foreach ($wares as $ware){

                $tr = $storageDocumentTableRowsRepository->find($row['id']);

                if($ware->ware >= $row_cancel) {

                    if($is_first_row){
                        $wc = $createWareConnectionService->
                        make(['storage_id'=> $doc->source_storage_id, 'characteristic_id' => $row['characteristic_id'],
                            'change' => -$row_cancel , 'butch_number_connection_id' => $ware->id
                        ]);
                        $tr->update(['ware_connection_id' => $wc->id]);
                        break;
                    } else {
                        $wc = $createWareConnectionService
                            ->make(['storage_id'=> $doc->source_storage_id, 'characteristic_id' => $row['characteristic_id'],
                                'change' => -$row_cancel, 'butch_number_connection_id' => $ware->id
                            ]);

                        $tr = $createStorageDocumentTableRowService
                            ->fillTableRow($doc, ['storage_document_id' => $doc['id'], 'count' => $row_cancel, 'price' => $row['characteristic_price_price']], $row['characteristic_id']);
                        $tr->update(['ware_connection_id' => $wc->id]);
                        break;
                    }
                } else {
                    if($is_first_row) {

                        // если первая строка документа, но будет больше одной всего
                        $wc = $createWareConnectionService
                            ->make(['storage_id'=> $doc->source_storage_id, 'characteristic_id' => $row['characteristic_id'],
                                'change' => -$ware->ware , 'butch_number_connection_id' => $ware->id
                            ]);

                        $tr->update(['count' => $ware->ware, 'ware_connection_id' => $wc->id]);


                        $row_cancel -= $ware->ware;

                        $is_first_row = false;
                    } else {
                        $wc = $createWareConnectionService
                            ->make(['storage_id'=> $doc->source_storage_id, 'characteristic_id' => $row['characteristic_id'],
                                'change' => -$ware->ware, 'butch_number_connection_id' => $ware->id
                            ]);


                        $tr = $createStorageDocumentTableRowService
                            ->fillTableRow($doc, ['storage_document_id' => $doc['id'], 'count' => $ware->ware, 'price' => $row['characteristic_price_price']], $row['characteristic_id']);
                        $tr->update(['ware_connection_id' => $wc->id]);
                        $row_cancel -= $ware->ware;
                    }
                }
            }
        }

        // изменение состояния документа на "Проведён"
        $doc->update(['is_set' => true]);

        return $doc;
    }
}
