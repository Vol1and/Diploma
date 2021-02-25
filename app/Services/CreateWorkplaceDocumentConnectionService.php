<?php


namespace App\Services;

use App\Models\WorkplaceDocumentConnection;
use App\Repositories\WorkplaceDocumentConnectionsRepository;

class CreateWorkplaceDocumentConnectionService
{
    public function make($data)
    {
        return (new WorkplaceDocumentConnection())->create($data);
    }
}
