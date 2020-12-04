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

    public function find($id){

        //return Model::find($id);
        $columns = [
            'id',
            'name',
            'margin'
        ];
        return $this->startConditions()->select($columns)->where('id', $id)->get()->first();

    }



}
