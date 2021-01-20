<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'date',
        'is_set',
        'doc_type_id',
        'agent_id',
        'storage_id'
    ];

    protected $with = ['storage', 'agent'];

    protected $appends = ['income_sum'];

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
    public function doc_connections(){
        return $this->hasMany(DocConnection::class);
    }

    public function getIncomeSumAttribute(){
        $result = 0;
        foreach ($this->doc_connections as $connection) $result += $connection->income_sum;
        return $result;
    }

}
