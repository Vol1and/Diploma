<?php


namespace App\Services;


use App\Models\Characteristic;

class CreateCharacteristicService
{
    public function make($med)
    {
        return (new Characteristic())->create($med);
    }
}
