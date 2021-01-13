<?php


namespace App\Repositories;
use App\Models\WareConnection as Model;

class WareConnectionsRepository extends BaseRepository
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
