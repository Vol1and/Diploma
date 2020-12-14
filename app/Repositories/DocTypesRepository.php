<?php


namespace App\Repositories;
use App\Models\DocType as Model;

class DocTypesRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Model::class;
    }

    public function getForCombobox()
    {
        return $this->StartConditions()->all();
    }

}
