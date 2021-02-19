<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wokrplace extends Model
{
    protected $fillable = [
    'name',
    'is_opened',
    'storage_id',
    'last_access'
    ];


    protected $with = ['storage'];

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }
}
