<?php


namespace App\Repositories;

use App\Models\Producer as Model;

use Faker\Provider\Base;

class ProducersRepository extends BaseRepository
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
