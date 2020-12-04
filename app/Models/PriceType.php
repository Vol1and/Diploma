<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceType extends Model
{

    protected $fillable = [
        'name',
        'margin'
    ];

    use SoftDeletes;
    use HasFactory;
}
