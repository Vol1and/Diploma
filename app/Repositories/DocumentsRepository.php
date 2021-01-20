<?php


namespace App\Repositories;

use App\Models\Document as Model;

class DocumentsRepository extends BaseRepository
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
        $result = $this->startConditions()
            ->select($columns)
            ->get();

        return $result;
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
            ->with(['doc_connections', 'doc_connections.characteristic'])
            ->get()->first();
    }


    public function getLatestId()
    {
        return $this->startConditions()->max('id');
    }
}
