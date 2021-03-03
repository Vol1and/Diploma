<?php


namespace App\Services;


use App\Models\AccountingConnection;

class CreateAccountingConnectionService
{
    public function make($data)
    {
        return (new AccountingConnection())->create($data);
    }
}
