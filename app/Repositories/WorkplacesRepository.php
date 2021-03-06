<?php


namespace App\Repositories;


use App\Models\Workplace as Model;

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
            'active_user_id',
            'storage_id',
            'last_access'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('id', $id)
            ->with(['storage'])
            ->get()->first();
    }

    public function how_many_active()
    {
        return $this->startConditions()->where('active_user_id','>', 0)->count();
    }
}
