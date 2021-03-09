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
                'price'  => 100,
                'characteristic_id' => 1
            ],
            [
                'price'  => 120,
                'characteristic_id' => 2
            ],
            [
                'price'  => 650,
                'characteristic_id' => 3
            ],
            [
                'price'  => 380,
                'characteristic_id' => 4
            ],
            [
                'price'  => 295,
                'characteristic_id' => 5
            ],
            [
                'price'  => 10,
                'characteristic_id' => 6
            ],
            [
                'price'  => 210,
                'characteristic_id' => 7
            ],
            [
                'price'  => 250,
                'characteristic_id' => 8
            ],
            [
                'price'  => 50,
                'characteristic_id' => 9
            ]
        ];

        DB::table('characteristic_prices')->insert($data);
    }
}
