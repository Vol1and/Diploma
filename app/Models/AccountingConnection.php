<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingConnection extends Model
{
    protected $fillable = [
        'date',
        'change',
        'document_id'
    ];

    protected $with = ['document'];

    public function document()
    {
        return $this->belongsTo(FinanceDocument::class);
    }

}
