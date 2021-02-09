<?php


namespace App\Repositories;
use App\Models\ButchNumberConnection as Model;

class ButchNumberConnectionsRepository extends BaseRepository
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
