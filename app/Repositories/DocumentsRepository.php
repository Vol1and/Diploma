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


    public function getLatestId()
    {
        return $this->startConditions()->max('id');
    }
}
