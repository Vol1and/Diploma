<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProducersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $producers = [
            ['name' =>'Производитель №1'],
            ['name' =>'Производитель №2'],
            ['name' =>'Производитель №3']
        ];
        \DB::table('producers')->insert($producers);
    }
}
