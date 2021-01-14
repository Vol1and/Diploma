<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WareConnection extends Model
{
    protected $fillable = [
        'characteristic_id',
        'change'
    ];

    public function characteristic()
    {
        return $this->belongsTo(Characteristic::class);
    }
}