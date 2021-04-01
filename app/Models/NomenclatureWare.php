<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomenclatureWare extends Model
{
    protected $table = "nomenclature_wares";


    public function nomenclature()
    {

        return $this->belongsTo(Nomenclature::class);
    }

    public function storage()
    {

        return $this->belongsTo(Storage::class);
    }
}
