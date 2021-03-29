<?php


namespace App\Repositories;


use App\Models\Barcode as Model;
use Illuminate\Database\Eloquent\Collection;

class BarcodesRepository extends BaseRepository
{


    /**
     * @return string
     */
    public function getModelClass()
    {
        return Model::class;
    }

    /**
     * @return Collection
     */
    public function getForComboBox()
    {
        return $this->startConditions()->all();
    }

    public function getTable(){
        return Model::all();
    }

    public function find($id){

        $columns = [
            'id',
            'code'
        ];
        return $this->startConditions()->select($columns)->where('id', $id)->get()->first();
    }

    public function findByCode($code){

        $columns = [
            'id',
            'code'
        ];
        return $this->startConditions()->select($columns)->where('code', $code)->get()->first();
    }
}
