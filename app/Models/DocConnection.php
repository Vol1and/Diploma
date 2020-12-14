<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocConnection extends Model
{
    protected $fillable = [
        'characteristic_id',
        'document_id',
        'amount',
        'price'
    ];
}
