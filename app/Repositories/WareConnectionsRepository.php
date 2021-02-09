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


    // поиск расходных проводок по характеристике из определённого документа
    public function isDecreasedAmount($doc_id, $characteristic_id)
    {
        $columns = [
            'butch_number_connection.butch_number',
            'change',
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('butch_number_connection.butch_number', $doc_id)
            ->where('characteristic_id', $characteristic_id)
            ->where('change', '<', 0)
            ->with(['butch_number_connection'])
            ->get();
    }

    // поиск всех расходных проводок по характеристике
    public function isDecreasedAmountAll($characteristic_id)
    {
        $columns = [
            'butch_number_connection.butch_number',
            'change',
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('characteristic_id', $characteristic_id)
            ->where('change', '<', 0)
            ->with(['butch_number_connection'])
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
