<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ware extends Model
{
    protected $table = "wares";


    public function characteristic()
    {

        return $this->belongsTo(Characteristic::class);
    }

    public function storage()
    {

        return $this->belongsTo(Storage::class);
    }
}
