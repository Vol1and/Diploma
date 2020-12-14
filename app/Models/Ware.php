<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ware extends Model
{
    protected $fillable = [
        'stock',
        'characteristic_id'
    ];
}
