<?php


namespace App\Services;


use App\Models\ButchNumberConnection;

class CreateButchNumberConnectionService
{
    // добавление сущности в РеестрПартионногоУчёта
    public function make($data)
    {
        return (new ButchNumberConnection())->create($data);
    }
}
