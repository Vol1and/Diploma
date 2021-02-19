<?php


namespace App\Repositories;
use App\Models\StorageDocumentTableRow as Model;

class StorageDocumentTableRowsRepository extends BaseRepository
{

    /**
     * @inheritDoc
     */
    public function getModelClass()
    {
        return Model::class;
    }

    // получение строк документа
    public function findRowsByDocId($document_id)
    {
        $columns = [
            'id',
            'count',
            'price',
            'storage_document_id',
            'characteristic_id',
            'ware_connection_id'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('storage_document_id', $document_id)
            ->with(['characteristic'])
            ->get();
    }


    public function find($id)
    {
        $columns = [
            'id',
            'count',
            'price',
            'storage_document_id',
            'characteristic_id',
            'ware_connection_id'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('id', $id)
            ->with(['characteristic', 'document', 'wareConnection'])
            ->get()->first();
    }

    // без связей для провдения
    public function forPush($doc_id){
        $columns = [
            'id',
            'count',
            'price',
            'storage_document_id',
            'characteristic_id',
            'ware_connection_id'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('storage_document_id', $doc_id)
            ->get();
    }
}
