<?php


namespace App\Repositories;
use App\Models\WareConnection as Model;
use DB;

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
