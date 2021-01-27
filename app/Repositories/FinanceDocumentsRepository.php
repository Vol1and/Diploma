<?php


namespace App\Repositories;

use App\Models\FinanceDocument as Model;

class FinanceDocumentsRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function getModelClass()
    {
        return Model::class;
    }

    public function getTable()
    {
        $columns = [
            'id',
            'date',
            'is_set',
            'doc_type_id',
            'agent_id',
            'storage_id',
            'comment'

        ];
        return $this->startConditions()
            ->select($columns)
            ->get();

    }

    public function find($id)
    {
        $columns = [
            'id',
            'date',
            'is_set',
            'doc_type_id',
            'agent_id',
            'storage_id',
            'comment'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('id', $id)
            ->with(['nomenclature','characteristic_price'])
            ->get()->first();
    }




    public function getFilter($start_date = null,$end_date = null, $agent = null, $storage = null)
    {

        $columns = [
            'id',
            'date',
            'is_set',
            'doc_type_id',
            'agent_id',
            'storage_id',
            'comment'

        ];

        $query = $this->startConditions()
            ->select($columns);

        if ($start_date && $end_date)
            $query = $query->whereBetween('date', [$start_date, $end_date]);

        if ($agent)
            $query = $query->where('agent_id', 'like', $agent);

        if ($storage)
            $query = $query->where('storage_id', 'like', $storage);



        return $query->get();

    }

    public function getLatestId()
    {
        return $this->startConditions()->max('id');
    }

}
