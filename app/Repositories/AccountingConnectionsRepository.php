<?php


namespace App\Repositories;


use App\Models\AccountingConnection as Model;

class AccountingConnectionsRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass()
    {
        return Model::class;
    }

    public function getTable(){
        return Model::all();
    }

    public function find($id)
    {
        $columns = [
            'id',
            'date',
            'change',
            'document_id'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('id', $id)
            ->with(['document'])
            ->get()->first();
    }
}
