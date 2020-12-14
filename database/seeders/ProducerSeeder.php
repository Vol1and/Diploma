<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProducerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $producers = [
            ['name' =>'Производитель №1', 'country'=>'Россия'],
            ['name' =>'Производитель №2', 'country'=>'Россия'],
            ['name' =>'Производитель №3', 'country'=>'Россия']
        ];
        \DB::table('producers')->insert($producers);
    }
}
