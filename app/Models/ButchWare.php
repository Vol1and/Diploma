<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ButchWare extends Model
{
    protected $table = "characteristic_butches_view";


    public function storage()
    {

        return $this->belongsTo(Storage::class);
    }

    public function characteristic()
    {

        return $this->belongsTo(Characteristic::class);
    }

    public function getDataToRealization()
    {
        return [
            'butch' => $this->butch,
            'storage_id' => $this->storage_id,
            'characteristic_id' => $this->characteristic_id,
            'ware' => $this->ware
        ];
    }
}
