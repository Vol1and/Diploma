<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workplace extends Model
{
    protected $fillable = [
        'name',
        'storage_id',
        'last_access',
        'active_user_id'
    ];


    protected $appends = ['active_user'];

    protected $with = ['storage'];

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function getActiveUserAttribute(){
        return User::find($this->active_user_id);
    }
}
