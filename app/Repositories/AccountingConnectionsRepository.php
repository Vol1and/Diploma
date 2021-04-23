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

    // получение баланса предприятия
    public function getBalance()
    {
        return $this->startConditions()
            ->sum('change');
    }

    // поиск сущности по id
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

    // применение процедуры для формирования графика ежедневных продаж
    public function getAllByNomenclatureAndStorageIdWithWares($date_start, $date_end)
    {
        return DB::select(
            'CALL find_all_cash(' . $date_start . ', '.$date_end.')'
        );
    }

    // применение процедуры для формирования графика итоговых продаж
    public function findAllSalesByPeriod($date_start, $date_end)
    {
        return DB::select(
            "CALL find_all_sales_by_period('". $date_start . "', '".$date_end."')"
        );
    }
}
