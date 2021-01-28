<?php


namespace App\Services;


use App\Models\WareConnection;

class CreateWareConnectionService
{
    public function make($med)
    {
        return (new WareConnection())->create($med);
    }
}
