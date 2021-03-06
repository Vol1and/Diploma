<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceDocument extends Model

{
    protected $fillable = [
        'date',
        'is_set',
        'doc_type_id',
        'agent_id',
        'storage_id',
        'doc_sum',
        'comment'
    ];

    protected $with = ['storage', 'agent'];

    //protected $appends = ['income_sum'];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function doc_type()
    {
        return $this->belongsTo(DocType::class);
    }
    public function table_rows(){
        return $this->hasMany(FinanceDocumentTableRow::class);
    }
}
