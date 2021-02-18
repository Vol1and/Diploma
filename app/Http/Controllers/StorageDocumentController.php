<?php

namespace App\Http\Controllers;

use App\Repositories\StorageDocumentsRepository;


class StorageDocumentController extends OriginController
{
    //ссылка на хранилище модели Producer
    private $storageDocumentsRepository;


    public function __construct()
    {
        //вызов констракт у родителя
        parent::__construct();

        //инициализация хранилищ и сервисов
        $this->storageDocumentsRepository = app(StorageDocumentsRepository::class);

    }


    public function index()
    {
        return $this->storageDocumentsRepository->getByDocTypeId(3)->toJson();
    }

}
