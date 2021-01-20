<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Characteristic extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'serial',
        'nomenclature_id',
        'expiry_date',
        'characteristic_price_id'
    ];
    //автоматом при подтягивании характеристики, подтягивает номенклатуру
    protected $with = ['nomenclature'];


    public function nomenclature()
    {

        return $this->belongsTo(Nomenclature::class);
    }

    public function prices()
    {
        return $this->hasMany(CharacteristicPrice::class);
    }

    public function getLastPriceAttribute(){
        return $this->prices[0];
    }


}
