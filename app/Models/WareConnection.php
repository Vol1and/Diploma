<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WareConnection extends Model
{
    protected $fillable = [
        'characteristic_id',
        'change',
        'storage_id',
        'butch_number_connection_id'
    ];


    protected $with = ['characteristic'];

    public function characteristic()
    {
        return $this->belongsTo(Characteristic::class);
    }

    public function butch_number_connection()
    {
        return $this->belongsTo(ButchNumberConnection::class);
    }
}
