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

    public function wares(){
        return $this->hasMany(Ware::class);
    }

    public function get_ware_by_storage($storage_id){

        $result = $this->wares->where('storage_id', $storage_id);
        if($result->isEmpty()) return 0;
        return $result->first();
         // return $this->wares->where('storage_id', $storage_id) != null ? $this->wares->where('storage_id', $storage_id)->first()->ware: 0;
    }

    function getDataToChooseInRealization($storage_id){
        return [
            'id' => $this->id,
            'ware' => $this->get_ware_by_storage($storage_id)->ware,
            'characteristic_price' => $this->characteristic_price,
            'serial' => $this->serial,
            'expiry_date' => $this->expiry_date,
            'name' => $this->name
        ];
    }



}
