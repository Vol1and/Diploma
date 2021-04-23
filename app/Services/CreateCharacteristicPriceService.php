<?php


namespace App\Services;


use App\Models\CharacteristicPrice;


class CreateCharacteristicPriceService
{
    // создание сущности цены для характеристики
    public function make($med)
    {
        return (new CharacteristicPrice())->create(['price' => $med['sell_price']]);
    }

    // изменение сущности цены для характеристики
    public function makeUpdate($med)
    {
        return (new CharacteristicPrice())->create(['price' => $med['sell_price'], 'characteristic_id' => $med['characteristic_id']]);
    }
}
