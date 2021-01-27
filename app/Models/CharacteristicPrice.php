<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CharacteristicPrice extends Model
{
    protected $fillable = [
        'price',
        'characteristic_id'
    ];

    use SoftDeletes;
}
