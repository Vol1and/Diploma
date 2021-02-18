<?php


namespace App\Repositories;

use App\Models\StorageDocument as Model;
class StorageDocumentsRepository extends BaseRepository
{

    /**
     * @inheritDoc
     */
    private
        $default_columns = [
        'id',
        'date',
        'is_set',
        'doc_type_id',
        'source_storage_id',
        'destination_storage_id',
        'doc_sum',
        'comment'
    ];

    public function getModelClass()
    {
        return Model::class;
    }

    public function getTable()
    {
        return $this->startConditions()
            ->select($this->default_columns)
            ->get();

    }

    public function getByDocTypeId($doc_type_id)
    {

        return $this->startConditions()
            ->select($this->default_columns)
            ->where('doc_type_id', '=', $doc_type_id)
            ->get();

    }

    public function find($id)
    {

        return $this->startConditions()
            ->select($this->default_columns)
            ->where('id', $id)
            ->with(['table_rows', 'table_rows.characteristic'])
            ->get()->first();
    }
}
