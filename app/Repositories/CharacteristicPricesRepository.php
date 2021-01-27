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


    public function find($id)
    {
        $columns = [
            'price',
            'characteristic_id'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('id', $id)
            ->get()->first();
    }

    public function getLatestPriceById()
    {
        return $this->startConditions()->max('id')->where();
    }
}
