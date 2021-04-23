<?php


namespace App\Repositories;

use App\Models\StorageDocument as Model;

class StorageDocumentsRepository extends BaseRepository
{

    /**
     * @inheritDoc
     */
    private
        $default_columns = [
        'id',
        'date',
        'is_set',
        'doc_type_id',
        'source_storage_id',
        'destination_storage_id',
        'doc_sum',
        'comment'
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

    public function getFilter($doc_type_id,$start_date = null, $end_date = null, $source_storage = null, $destination_storage = null)
    {
        $query = $this->startConditions()
            ->select($this->default_columns)->where('doc_type_id',$doc_type_id );

        if ($start_date && $end_date)
            $query = $query->whereBetween('date', [$start_date, $end_date]);

        if ($source_storage)
            $query = $query->where('source_storage_id', 'like', $source_storage);

        if ($destination_storage)
            $query = $query->where('destination_storage_id', 'like', $destination_storage);


        return $query->get();

    }
}
