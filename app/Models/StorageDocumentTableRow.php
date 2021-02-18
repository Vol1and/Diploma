<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageDocumentTableRow extends Model
{
    protected $fillable = [
        'count',
        'price',
        'storage_document_id',
        'characteristic_id',
        'ware_connection_id'
    ];

    public function characteristic()
    {
        return $this->belongsTo(Characteristic::class);
    }

    public function document()
    {
        return $this->belongsTo(StorageDocument::class);
    }

    public function wareConnection()
    {
        return $this->belongsTo(WareConnection::class);
    }

    public function sum()
    {
        return $this->count * $this->price;
    }
}
