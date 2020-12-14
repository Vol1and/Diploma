<?php


namespace App\Repositories;
use App\Models\DocConnection as Model;

class DocConnectionsRepository extends BaseRepository
{

    /**
     * @return string
     */
    public function getModelClass()
    {
        return Model::class;
    }

}
