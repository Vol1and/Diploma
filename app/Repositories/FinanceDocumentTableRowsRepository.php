<?php


namespace App\Repositories;
use App\Models\FinanceDocumentTableRow as Model;


class FinanceDocumentTableRowsRepository extends BaseRepository
{

    /**
     * @inheritDoc
     */
    public function getModelClass()
    {
        return Model::class;
    }

    public function find($id)
    {
        $columns = [
            'id',
            'count',
            'characteristic_id',
            'finance_document_id',
            'ware_connection_id',
            'price'
        ];
        return $this->startConditions()
            ->select($columns)
            ->where('id', $id)
            ->with(['characteristic', 'document', 'wareConnection'])
            ->get()->first();
    }
}
