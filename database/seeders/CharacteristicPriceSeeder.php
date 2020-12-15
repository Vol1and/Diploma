<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CharacteristicPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'characteristic_price'  => 100
            ],
            [
                'characteristic_price'  => 120
            ],
            [
                'characteristic_price'  => 650
            ],
            [
                'characteristic_price'  => 380
            ],
            [
                'characteristic_price'  => 295
            ]
        ];

        DB::table('characteristic_prices')->insert($data);
    }
}
