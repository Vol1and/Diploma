<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocConnection extends Model
{
    protected $fillable = [
        'count',
        'table_id',
        'characteristic_id',
        'document_id',

        'price'
    ];

    protected $with = [
        'characteristic'
    ];
    protected $appends = [
        'nomenclature'
    ];

    public function characteristic()
    {
        return $this->belongsTo(Characteristic::class);
    }

    public function getNomenclatureAttribute()
    {
        return $this->characteristic->nomenclature;
    }


    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function income_sum()
    {
        return $this->count * $this->income_price;
    }
}
