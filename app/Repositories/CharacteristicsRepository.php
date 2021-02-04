<?php


namespace App\Repositories;

use App\Models\Characteristic as Model;
use DB;


class CharacteristicsRepository extends BaseRepository
{

    public function getModelClass()
    {
        return Model::class;
    }

    public function getTable()
    {
        return Model::all();
    }

    public function getCharacteristicsByNomenclatureId($nomenclature_id)
    {

        return DB::select(
            'CALL find_characteristics_procedure(' . $nomenclature_id . ')'
        );
    }


    public function find($id)
    {
        $columns = [
            'id',
            'name',
            'serial',
            'nomenclature_id',
            'expiry_date',
            'characteristic_price_id'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('id', $id)
            ->with(['nomenclature', 'characteristic_price'])
            ->get()->first();
    }

    // проверка наличия характеристики в БД для конкретной номенклатуры
    public function findBySerial($nomenclature_id, $serial, $expiry_date)
    {
        $columns = [
            'id',
            'serial',
            'nomenclature_id',
            'expiry_date',
            'characteristic_price_id'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('nomenclature_id', $nomenclature_id)
            ->where('serial', $serial)
            // ->where('expiry_date', $expiry_date)
            // ->with(['nomenclature','characteristic_price'])
            ->withTrashed()->get()->first();
    }
}
