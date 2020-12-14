<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocType extends Model
{
    protected $fillable
        = [
            'name'
            ,'is_income'
        ];

    use SoftDeletes;
}
