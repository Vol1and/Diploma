<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceDocumentTableRow extends Model
{
    protected $fillable = [
        'count',
        'characteristic_id',
        'finance_document_id',
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
        return $this->belongsTo(FinanceDocument::class);
    }

    public function income_sum()
    {
        return $this->count * $this->income_price;
    }
}
