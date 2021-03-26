<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarcodeConnection extends Model
{
    protected $fillable = [
        'nomenclature_id',
        'barcode_id'
    ];

    protected $with = ['nomenclature', 'barcode'];

    public function nomenclature()
    {
        return $this->belongsTo(Nomenclature::class);
    }

    public function barcode()
    {
        return $this->belongsTo(Barcode::class);
    }

}
