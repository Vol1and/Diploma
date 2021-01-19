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

    public function characteristic()
    {
        return $this->belongsTo(Characteristic::class);
    }


    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
