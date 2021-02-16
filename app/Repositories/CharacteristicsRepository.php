<?php


namespace App\Repositories;

use App\Models\Characteristic as Model;


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

    public function getAllByNomenclatureAndStorageIdWithWares($nomenclature_id, $storage_id)
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
            ->with(['butch_wares', 'characteristic_price', 'wares'])
            ->where('nomenclature_id', $nomenclature_id)
            ->get();
    }

       // return DB::select(
       //     'CALL find_characteristics_procedure(' . $nomenclature_id . ', '.$storage_id.')'
       // );


    // поиск в БД характеристики по её id
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

    // проверка наличия характеристики в БД для конкретной номенклатуры по id
    public function findById($nomenclature_id, $id)
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
            ->where('id', $id)
            // ->with(['nomenclature','characteristic_price'])
            ->withTrashed()->get()->first();
    }

    // проверка наличия характеристики в БД для конкретной номенклатуры по серие и сроку годности
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

    // проверка наличия характеристики в БД для конкретной номенклатуры
    public function getAllByNomenclatureId($nomenclature_id)
    {
        $columns = [
            'id',
            'serial',
            'nomenclature_id',
            'expiry_date',
            'name'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('nomenclature_id', $nomenclature_id)
            ->get();
    }
}
