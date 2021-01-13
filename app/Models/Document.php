<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'date',
        'is_set',
        'doc_type_id',
        'agent_id'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function doc_type()
    {
        return $this->belongsTo(DocType::class);
    }
}
