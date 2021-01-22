<?php


namespace App\Repositories;
use App\Models\CharacteristicPrice as Model;

class CharacteristicPricesRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Model::class;
    }

    public function getLatestPriceById()
    {
        return $this->startConditions()->max('id')->where();
    }
}
