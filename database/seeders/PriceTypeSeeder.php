<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class PriceTypeSeeder extends Seeder
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
                'name'  => 'Общая группа',
                'margin' => 15
            ],
            [
                'name'  => 'Специальная группа №1',
                'margin' => 12
            ],
            [
                'name'  => 'Специальная группа №2',
                'margin' => 5
            ]
        ];


        DB::table('price_types')->insert($data);
    }
}
