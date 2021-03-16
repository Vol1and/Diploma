<?php


namespace App\Repositories;

use App\Models\Storage as Model;

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

    public function getStoragesId(){
        $result = $this->startConditions()
            ->select('id')
            ->get();
        $res = [];
        foreach ($result as $id){
            $res[] = $id->id;
        }
        return $res;
    }

}
