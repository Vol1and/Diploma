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
}
