<?php


namespace App\Repositories;

use App\Models\ButchWare as Model;


class ButchWaresRepository extends BaseRepository
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

            ->get();

        return $result;
    }

    //public function getByNomenclatureAndStorage($nomenclature_id, $storage_id){
    //    $result = $this->startConditions()
    //        ->select('*')
    //        ->where('nomenclature_id', )
    //        ->get();
//
    //    return $result;
    //}

}
