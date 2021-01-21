<?php


namespace App\Repositories;

use App\Models\FinanceDocument as Model;

class FinanceDocumentsRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass()
    {
        return Model::class;
    }

    public function getTable()
    {
        $columns = [
            'id',
            'date',
            'is_set',
            'doc_type_id',
            'agent_id',
            'storage_id'

        ];
        return $this->startConditions()
            ->select($columns)
            ->get();

    }

    public function find($id)
    {

        $columns = [
            'id',
            'date',
            'is_set',
            'doc_type_id',
            'agent_id',
            'storage_id'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('id', $id)
            ->with(['table_rows', 'table_rows.characteristic'])
            ->get()->first();
    }


    public function getLatestId()
    {
        return $this->startConditions()->max('id');
    }

}
