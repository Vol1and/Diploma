<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkplaceDocumentConnection extends Model
{
    protected $fillable = [
        'workplace_id',
        'document_id',
        'user_id'
    ];

    protected $with = ['document', 'workplace', 'user'];

    public function workplace()
    {
        return $this->belongsTo(Workplace::class);
    }

    public function document()
    {
        return $this->belongsTo(FinanceDocument::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
