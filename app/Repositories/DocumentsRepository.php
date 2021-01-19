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

    public function getTable(){
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
            ->with(['storage', 'agent'])
            ->get();

        return $result;
    }

    public function getLatestId()
    {
        return $this->startConditions()->max('id');
    }
}
