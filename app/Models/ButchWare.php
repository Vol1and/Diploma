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

    public function nomenclature()
    {

        return $this->belongsTo(Storage::class);
    }
}
