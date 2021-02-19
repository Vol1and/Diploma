<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentCreateRequest;
use App\Repositories\StorageDocumentsRepository;
use App\Services\CreateStorageDocumentService;
use App\Services\UpdateStorageDocumentService;


class StorageDocumentController extends OriginController
{
    //ссылка на хранилище модели Producer
    private $storageDocumentsRepository;
    private $createStorageDocumentService;
    private $updateStorageDocumentService;


    public function __construct()
    {
        //вызов констракт у родителя
        parent::__construct();

        //инициализация хранилищ и сервисов
        $this->storageDocumentsRepository = app(StorageDocumentsRepository::class);
        $this->createStorageDocumentService = app(CreateStorageDocumentService::class);
        $this->updateStorageDocumentService = app(UpdateStorageDocumentService::class);

    }


    public function index()
    {
        return $this->storageDocumentsRepository->getByDocTypeId(3)->toJson();
    }

    public function cancellationCreate(DocumentCreateRequest $request)
    {
        // получение данных
        $data = $request->input('item');
        if(empty($data)) return response(null,400);

        $meds = $data['table_rows'];
        if(empty($meds)) return response(null,400);

        // добавление нового документа
        $doc = $this->createStorageDocumentService->createStorageDoc($data,$meds);
        if(empty($doc)) return response(null,500);


        if($request->input('state')) $result = $this->createStorageDocumentService->pushStorageDoc($doc->id);
    }

    public function cancellationUpdate(DocumentCreateRequest $request, $id)
    {
        // получение данных
        $data = $request->input('item');
        if(empty($data)) return response(null,400);

        $deleted = $data['deleted_rows'];

        $updated = $data['updated_rows'];


        $result = $this->updateStorageDocumentService->updateCancellation($data, $deleted, $updated, $id);

        if(empty($result)) return response(null,500);

        if($request->input('state')) $result = $this->createStorageDocumentService->pushStorageDoc($id);

    }


}
