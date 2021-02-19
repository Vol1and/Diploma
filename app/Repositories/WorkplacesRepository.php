<?php


namespace App\Repositories;


use App\Models\Wokrplace as Model;

class WorkplacesRepository extends BaseRepository
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
            'name',
            'is_opened',
            'storage_id',
            'last_access'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('id', $id)
            ->with(['storage'])
            ->get()->first();
    }
}
