<?php


namespace App\Repositories;

use App\Models\Storage as Model;

use Faker\Provider\Base;

class StoragesRepository extends BaseRepository
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
        ];
        return $this->startConditions()->select($columns)->where('id', $id)->get()->first();

    }



}
