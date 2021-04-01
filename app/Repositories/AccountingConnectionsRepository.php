<?php


namespace App\Repositories;


use App\Models\AccountingConnection as Model;
use DB;

class AccountingConnectionsRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass()
    {
        return Model::class;
    }

    public function getTable(){
        return Model::all();
    }



    public function getBalance()
    {

        return $this->startConditions()
            ->sum('change');
    }

    public function find($id)
    {
        $columns = [
            'id',
            'date',
            'change',
            'document_id'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('id', $id)
            ->with(['document'])
            ->get()->first();
    }

    public function getAllByNomenclatureAndStorageIdWithWares($date_start, $date_end)
    {
        return DB::select(
            'CALL find_all_cash(' . $date_start . ', '.$date_end.')'
        );
    }

    public function findAllSalesByPeriod($date_start, $date_end)
    {
        return DB::select(
            "CALL find_all_sales_by_period('". $date_start . "', '".$date_end."')"
        );
    }
}
