<?php


namespace App\Repositories;

use App\Models\MedForm as Model;


/**
 * Class MedFormRepository
 * @package App\Repositories
 */
class MedFormsRepository extends BaseRepository
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
