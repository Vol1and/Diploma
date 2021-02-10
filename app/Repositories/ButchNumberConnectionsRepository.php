<?php


namespace App\Repositories;
use App\Models\ButchNumberConnection as Model;

class ButchNumberConnectionsRepository extends BaseRepository
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

    // поиск сущности по полю Номер партии
    public function findByButchNumber($butchNumber)
    {
        $columns = [
            'id',
            'butch_number'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('butch_number', $butchNumber)
            ->get()
            ->first();

    }
}
