<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nomenclature extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'producer_id',
        'price_type_id',
        'med_form_id'
    ];

    protected  $with = [
        'producer',

    ];

    public function price_type()
    {

        return $this->belongsTo(PriceType::class)->withTrashed();
    }

    public function producer()
    {

        return $this->belongsTo(Producer::class)->withTrashed();
    }

    public function med_form()
    {

        return $this->belongsTo(MedForm::class);
    }
}
