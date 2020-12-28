<?php


namespace App\Repositories;

use App\Models\Characteristic as Model;


class CharacteristicsRepository extends BaseRepository
{

    public function getModelClass()
    {
        return Model::class;
    }

    public function getTable(){
        return Model::all();
    }

    public function forNomenclature($nomenclature_id){
        $columns = [
            'id',
            'serial',
            'expiry_date',
            'nomenclature_id',
         ];
        return $this->startConditions()
            ->select($columns)
            ->where('nomenclature_id', $nomenclature_id)
            ->with('nomenclature')
            ->get();

    }
}
