<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workplace extends Model
{
    protected $fillable = [
    'name',
    'storage_id'
    ];


    protected $with = ['storage'];

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }
}
