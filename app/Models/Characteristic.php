<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Characteristic extends Model
{

    protected $fillable = [
        'serial',
        'nomenclature_id',
        'expiry_date',
        'export'
    ];

    use SoftDeletes;
}
