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
    protected $with = ['nomenclature','characteristic_price' ];



    public function nomenclature()
    {

        return $this->belongsTo(Nomenclature::class);
    }

    public function characteristic_price()
    {
        return $this->belongsTo(CharacteristicPrice::class);
    }

    public function butch_wares(){
        return $this->hasMany(ButchWare::class);
    }

    public function wares(){
        return $this->hasMany(Ware::class);
    }


}
