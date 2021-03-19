<?php


namespace App\Repositories;

use App\Models\FinanceDocument as Model;

class FinanceDocumentsRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */

    private $default_columns = [
        'id',
        'date',
        'is_set',
        'doc_type_id',
        'agent_id',
        'storage_id',
        'comment',
        'doc_sum'

    ];

    public function getModelClass()
    {
        return Model::class;
    }

    public function getTable()
    {
        return $this->startConditions()
            ->select($this->default_columns)
            ->get();

    }

    public function getByDocTypeId($doc_type_id)
    {

        return $this->startConditions()
            ->select($this->default_columns)
            ->where('doc_type_id', '=', $doc_type_id)
            ->get();

    }

    public function find($id)
    {

        return $this->startConditions()
            ->select($this->default_columns)
            ->where('id', $id)
            ->with(['table_rows', 'table_rows.characteristic'])
            ->get()->first();
    }


    public function getFilter($doc_type_id,$start_date = null, $end_date = null, $agent = null, $storage = null)
    {


        $query = $this->startConditions()
            ->select($this->default_columns)->where('doc_type_id',$doc_type_id );

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
