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
        $columns = [
            'id',
            'nomenclature_id',
            'barcode_id'
        ];
        return $this->startConditions()->select($columns)->with(['nomenclature', 'barcode'])->get();
    }

    public function find($id){

        $columns = [
            'id',
            'nomenclature_id',
            'barcode_id'
        ];
        return $this->startConditions()->select($columns)->where('id', $id)->get()->first();
    }

    // поиск id штрихкода по id номенклатуры
    public function findByNomenclatureId($nomenclature_id){

        $columns = [
            'id',
            'nomenclature_id',
            'barcode_id'
        ];
        return $this->startConditions()->select($columns)->with(['nomenclature', 'barcode'])->where('nomenclature_id', $nomenclature_id)->get();
    }

    // поиск id номенклатуры по id штрихкода
    public function findByBarcodeId($barcode_id){

        $columns = [
            'id',
            'nomenclature_id',
            'barcode_id'
        ];
        return $this->startConditions()->select($columns)->where('barcode_id', $barcode_id)->get()->first();
    }

    // поиск id номенклатуры по id штрихкода
    public function checkDuplicated($nomenclature_id,$barcode_id){

        $columns = [
            'id',
            'nomenclature_id',
            'barcode_id'
        ];
        return $this->startConditions()->select($columns)
            ->where('barcode_id', $barcode_id)
            ->where('nomenclature_id', $nomenclature_id)
            ->count();
    }
}
