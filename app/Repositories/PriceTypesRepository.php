<?php


namespace App\Repositories;

use App\Models\PriceType as Model;

use Faker\Provider\Base;

class PriceTypesRepository extends BaseRepository
{

    public function getModelClass()
    {
        return Model::class;
    }

    public function getTable(){
        return Model::all();
    }


//   public function getComboBox(){
//       $columns = 'id, name';
//       $result = $this->StartConditions()
//           ->selectRaw($columns)
//           ->toBase()
//           ->get();
//       return $result;
//   }
}
