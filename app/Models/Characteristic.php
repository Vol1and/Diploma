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

    public function get_ware_by_storage($storage_id){
        return $this->wares->where('storage_id', $storage_id)->first()->ware;
    }

    public function get_butch_wares_by_storage($storage_id){
        foreach ($this->butch_wares->where('storage_id', $storage_id) as $butch) $butches[] = $butch->getDataToRealization();
        return $butches;
    }


    function getDataToChooseInRealization($storage_id){
        return [
            'butch_wares'=> $this->get_butch_wares_by_storage($storage_id),
            'ware' => $this->get_ware_by_storage($storage_id),
            'characteristic_price' => $this->characteristic_price,
            'serial' => $this->serial,
            'expiry_date' => $this->expiry_date,
            'name' => $this->name
        ];
    }


}
