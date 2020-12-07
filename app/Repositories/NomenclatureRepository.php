<?php


namespace App\Repositories;

use App\Models\Nomenclature as Model;


class NomenclatureRepository extends BaseRepository
{

    public function getModelClass()
    {
        return Model::class;
    }

    public function getTable(){
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


  //  public function getComboBox(){
  //      $columns = 'id, name';
  //      $result = $this->StartConditions()
  //          ->selectRaw($columns)
  //          ->toBase()
  //          ->get();
  //      return $result;
  //  }
}
