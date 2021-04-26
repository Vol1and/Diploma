<?php


namespace App\Services;


use App\Models\AccountingConnection;

class CreateAccountingConnectionService
{
    // добавление записи в РеестрБухгалтерскихОпераций
    public function make($data)
    {
        return (new AccountingConnection())->create($data);
    }
}
