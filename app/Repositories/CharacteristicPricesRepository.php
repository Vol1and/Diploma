<?php


namespace App\Repositories;
use App\Models\CharacteristicPrice;
use App\Models\CharacteristicPrice as Model;
use DB;

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

    public function getLatestPriceForCharacteristic($characteristic_id)
    {
        // TODO: выполнить поиск последней цены
        $columns = [
            'price',
            'characteristic_id',
            'created_at'
        ];

        return $this->startConditions()
            ->select($columns)
            ->where('characteristic_id', $characteristic_id)
            ->latest()
            ->first();
    }

    public function getLatestPriceById()
    {
        return $this->startConditions()->max('id')->where();
    }
}
