<?php


namespace App\Repositories;
use App\Models\WareConnection as Model;

class WareConnectionsRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Model::class;
    }

    public function getTable(){
        return Model::all();
    }



    public function forCharacteristicSelection($nomenclature_id){
        $columns = [
            'id',
            'serial',
            'expiry_date',
            'nomenclature_id',
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('nomenclature_id', $nomenclature_id)
            ->with('nomenclature')
            ->get();

    }

    public function find($id)
    {
        $columns = [
            'characteristic_id',
            'change'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('id', $id)
            ->with(['characteristic'])
            ->get()->first();
    }
}
