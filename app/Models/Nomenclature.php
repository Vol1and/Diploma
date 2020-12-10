<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nomenclature extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'producer_id',
        'price_type_id'
    ];

    public function price_type()
    {

        return $this->belongsTo('App\Models\PriceType');
    }

    public function producer()
    {

        return $this->belongsTo('App\Models\Producer');
    }
}
