<?php


namespace App\Services;


use App\Models\Characteristic;
use App\Repositories\CharacteristicPricesRepository;
use App\Repositories\CharacteristicsRepository;

class CreateCharacteristicService
{
    // метод добавления сущности Характеристика
    public function make($med)
    {
        return (new Characteristic())->create($med);
    }

    // метод создания характеристики и подчинённых сущностей
    public function add($ch)
    {
        $createCharacteristicPriceService= app(CreateCharacteristicPriceService::class);
        $characteristicsRepository= app(CharacteristicsRepository::class);

        // изменение выбранного в дате числа на первое
        $ch['expiry_date'] = substr_replace($ch['expiry_date'],'01',strlen($ch['expiry_date'])-2);

        // проверка наличия характеристики в БД
        $checkCharacteristic = $characteristicsRepository->findBySerial($ch['nomenclature_id'],$ch['serial'],$ch['expiry_date']);
        if($checkCharacteristic) return response("Раззуйте глаза!", 500);
        else
        {
            // создание цены для характеристики со значением характеристики по умолчанию
            $cp = $createCharacteristicPriceService->make(['sell_price' => 0] + $ch);
            if (!$cp) return response(null,500);

            // в массив добавляется значение id цены характеристики
            $ch['characteristic_price_id'] = $cp->id;

            // добавление новой характеристики
            $characteristic = $this->make($ch);
            if (!$characteristic) return response("Ошибка добавления характеристики",500);

            // добавление значения id характеристики в таблицу Цены характеристик
            $cp->update(['characteristic_id' => $characteristic->id]);
        }
        return response("Характеристика добавлена!",200);
    }
}
