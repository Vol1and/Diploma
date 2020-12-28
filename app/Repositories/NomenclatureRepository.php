<?php


namespace App\Repositories;

use App\Models\Nomenclature as Model;


class NomenclatureRepository extends BaseRepository
{

    public function getModelClass()
    {
        return Model::class;
    }

    public function getTable()
    {
        $columns = [
            'id',
            'name',
            'producer_id',
            'price_type_id'

        ];
        $result = $this->startConditions()
            ->select($columns)
            ->with(['producer', 'price_type'])
            ->get();

        return $result;
    }

    public function find($id)
    {

        $columns = [
            'id',
            'name',
            'producer_id',
            'price_type_id'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('id', $id)
            ->with(['producer', 'price_type'])
            ->get()
            ->first();

    }

    public function getTotalCount(){
        return $this->startConditions()->all()->count();
    }

    //public function getLastUpdated(){
        //dd(Model::orderBy('updated_at','desc')->first());
      //  return Model::orderBy('updated_at','desc')->first();

    //}

}
