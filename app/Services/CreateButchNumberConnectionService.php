<?php


namespace App\Services;


use App\Models\ButchNumberConnection;

class CreateButchNumberConnectionService
{
    public function make($data)
    {
        return (new ButchNumberConnection())->create($data);
    }
}
