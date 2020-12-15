<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CharacteristicPrice extends Model
{
    protected $fillable = [
        'characteristic_price'
    ];

    use SoftDeletes;
}
