<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PriceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' =>'Общая группа ', 'margin' => 15],
            ['name' =>'Специальная группа №1', 'margin' => 12],
            ['name' =>'Специальная группа №2', 'margin' => 5]
        ];
        \DB::table('price_types')->insert($types);
    }
}
