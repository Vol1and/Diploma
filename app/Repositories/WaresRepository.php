<?php


namespace App\Repositories;
use App\Models\Ware as Model;

class WaresRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Model::class;
    }

    public function getTable(){
        return Model::all();
    }
}
