<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producer extends Model
{
    protected $fillable = [
        'name',
        'country'
    ];

    use SoftDeletes;
    use HasFactory;
}
