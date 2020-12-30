<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

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
                'name' => 'Общая группа',
                'margin' => 15, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Специальная группа №1',
                'margin' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Специальная группа №2',
                'margin' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),

            ]
        ];


        DB::table('price_types')->insert($data);
    }
}
