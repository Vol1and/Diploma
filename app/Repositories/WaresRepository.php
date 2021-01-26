<?php


namespace App\Repositories;

use App\Models\Ware as Model;


class WaresRepository extends BaseRepository
{

    public function getModelClass()
    {
        return Model::class;
    }

    public function getTable(){
       // $columns = [
       //     'characteristic_id',
       //     'ware',
       //     'storage_id'
//
//
       // ];
        $result = $this->startConditions()
            ->select('*')
            ->with(['characteristic','storage', 'characteristic.nomenclature'])
            ->get();

        return $result;
    }

}
