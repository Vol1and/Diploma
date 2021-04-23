<?php


namespace App\Services;

use App\Models\WorkplaceDocumentConnection;
use App\Repositories\WorkplaceDocumentConnectionsRepository;

class CreateWorkplaceDocumentConnectionService
{
    // создание сущности РеестраКассовыхОпервций
    public function make($data)
    {
        return (new WorkplaceDocumentConnection())->create($data);
    }
}
