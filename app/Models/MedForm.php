<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedForm extends Model
{
    protected $fillable = [
        'name'
    ];
    use SoftDeletes;
}
