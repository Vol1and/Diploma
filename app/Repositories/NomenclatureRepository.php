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
        return Model::all();
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
