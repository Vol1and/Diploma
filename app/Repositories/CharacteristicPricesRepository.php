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
}
