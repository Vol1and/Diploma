<?php


namespace App\Repositories;


use App\Models\WorkplaceDocumentConnection as Model;
use Carbon\Carbon;

class WorkplaceDocumentConnectionsRepository extends BaseRepository
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

    public function find($id)
    {
        $columns = [
            'id',
            'workplace_id',
            'document_id',
            'user_id'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('id', $id)
            ->with(['document', 'workplace', 'user'])
            ->get()->first();
    }

    // поиск связи по id документа
    public function findByDocument($document_id)
    {
        $columns = [
            'id',
            'workplace_id',
            'document_id',
            'user_id'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('document_id', $document_id)
            ->with(['document', 'workplace', 'user'])
            ->get()->first();
    }

    // выборка по указанному РМК за сегодня
    public function findByWorkplace($workplace_id)
    {
        $columns = [
            'id',
            'workplace_id',
            'document_id',
            'user_id'
        ];
        return $this->startConditions()
            ->select($columns)
            ->whereDate('created_at', '=', Carbon::today()->toDateString())
            ->where('workplace_id', $workplace_id)
            ->with(['document', 'workplace', 'user'])
            ->get();
    }

    // выборка по указанному РМК в указанную дату
    public function findByWorkplaceAndDate($workplace_id, $date)
    {
        $columns = [
            'id',
            'workplace_id',
            'document_id',
            'user_id'
        ];
        return $this->startConditions()
            ->select($columns)
            ->whereDate('created_at', '=', $date)
            ->where('workplace_id', $workplace_id)
            ->with(['document', 'workplace', 'user'])
            ->get();
    }

    // выборка по указанному РМК за период
    public function findByWorkplaceAndDatePeriod($workplace_id, $date_start, $date_end)
    {
        $columns = [
            'id',
            'workplace_id',
            'document_id',
            'user_id'
        ];
        return $this->startConditions()
            ->select($columns)
            ->whereDate('created_at', '<=', $date_start)
            ->whereDate('created_at', '>=', $date_end)
            ->where('workplace_id', $workplace_id)
            ->with(['document', 'workplace', 'user'])
            ->get();
    }
}
