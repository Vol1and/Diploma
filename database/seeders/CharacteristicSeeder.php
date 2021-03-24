<?php


namespace Database\Seeders;


use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CharacteristicSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'serial'      => 'ТА291821',
                'expiry_date' => date("Y-m-d", mktime(0, 0, 0, date("m")+4,   1,   date("Y")+2)),
                'characteristic_price_id'      => 1,
                'nomenclature_id'     => 857,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 19,   date("Y"))), 'updated_at' =>Carbon::now()
            ],
            [
                'serial'      => 'КЛ2088',
                'expiry_date' => date("Y-m-d", mktime(0, 0, 0, date("m")+3,   1,   date("Y")+1)),
                'characteristic_price_id'      => 2,
                'nomenclature_id'     => 216,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 19,   date("Y"))), 'updated_at' =>Carbon::now()
            ],
            [
                'serial'      => 'JG2971',
                'expiry_date' => date("Y-m-d", mktime(0, 0, 0, date("m")+7,   1,   date("Y")+1)),
                'characteristic_price_id'      => 3,
                'nomenclature_id'     => 140,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 15, 12, date("m"),   date("d") - 19,   date("Y"))), 'updated_at' =>Carbon::now()
            ],
            [
                'serial'      => 'KT29271',
                'expiry_date' => date("Y-m-d", mktime(0, 0, 0, date("m")+3,   1,   date("Y")+2)),
                'characteristic_price_id'      => 4,
                'nomenclature_id'     => 142,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 15, 12, date("m"),   date("d") - 19,   date("Y"))), 'updated_at' =>Carbon::now()
            ],
            [
                'serial'      => 'FA295912',
                'expiry_date'      => date("Y-m-d", mktime(0, 0, 0, date("m")+7,   1,   date("Y")+2)),
                'characteristic_price_id'      => 5,
                'nomenclature_id'     => 586,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 15, 12, date("m"),   date("d") - 19,   date("Y"))), 'updated_at' =>Carbon::now()
            ],
            [
                'serial'      => 'GG2211',
                'expiry_date'      => date("Y-m-d", mktime(0, 0, 0, date("m")+7,   1,   date("Y")+4)),
                'characteristic_price_id'      => 6,
                'nomenclature_id'     => 662,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 14,   date("Y"))), 'updated_at' =>Carbon::now()
            ],
            [
                'serial'      => 'SM68422',
                'expiry_date'      => date("Y-m-d", mktime(0, 0, 0, date("m")+1,   1,   date("Y")+2)),
                'characteristic_price_id'      => 7,
                'nomenclature_id'     => 666,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 14,   date("Y"))), 'updated_at' =>Carbon::now()
            ],
            [
                'serial'      => 'TP40029',
                'expiry_date'      => date("Y-m-d", mktime(0, 0, 0, date("m")-5,   1,   date("Y")+3)),
                'characteristic_price_id'      => 8,
                'nomenclature_id'     => 810,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 14,   date("Y"))), 'updated_at' =>Carbon::now()
            ],
            [
                'serial'      => '048',
                'expiry_date'      => date("Y-m-d", mktime(0, 0, 0, date("m")-2,   1,   date("Y")+5)),
                'characteristic_price_id'      => 9,
                'nomenclature_id'     => 461,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 14,   date("Y"))), 'updated_at' =>Carbon::now()
            ]
        ];

        DB::table('characteristics')->insert($data);
    }
}
