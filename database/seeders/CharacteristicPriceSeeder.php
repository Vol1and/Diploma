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
                'price'  => 100
            ],
            [
                'price'  => 120
            ],
            [
                'price'  => 650
            ],
            [
                'price'  => 380
            ],
            [
                'price'  => 295
            ]
        ];

        DB::table('characteristic_prices')->insert($data);
    }
}
