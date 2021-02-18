<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageDocument extends Model
{
    protected $fillable = [
        'date',
        'is_set',
        'doc_type_id',
        'source_storage_id',
        'destination_storage_id',
        'doc_sum',
        'comment'
    ];

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function doc_type()
    {
        return $this->belongsTo(DocType::class);
    }
    public function table_rows()
    {
        return $this->hasMany(StorageDocumentTableRow::class);
    }
}
