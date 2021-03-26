<?php


namespace App\Repositories;


use App\Models\BarcodeConnection as Model;
use Illuminate\Database\Eloquent\Collection;

class BarcodeConnectionsRepository extends BaseRepository
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
            'nomenclature_id',
            'barcode_id'
        ];
        return $this->startConditions()->select($columns)->where('id', $id)->get()->first();
    }

    public function findByNomenclature($nomenclature_id){

        $columns = [
            'id',
            'nomenclature_id',
            'barcode_id'
        ];
        return $this->startConditions()->select($columns)->where('nomenclature_id', $nomenclature_id)->get();
    }
}
