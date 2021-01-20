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
            ['name' =>'Общая группа '],
            ['name' =>'Специальная группа №1'],
            ['name' =>'Специальная группа №2']
        ];
        \DB::table('price_types')->insert($types);
    }
}
