<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;


class MedFormSeeder extends Seeder
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
                'name'  => 'таблетки'
            ],
            [
                'name'  => 'капсулы'
            ],
            [
                'name'  => 'порошок'
            ],
            [
                'name'  => 'драже'
            ],
            [
                'name'  => 'гранулы'
            ],
            [
                'name'  => 'карамель'
            ],
            [
                'name'  => 'лек. карандаш'
            ],
            [
                'name'  => 'глоссет'
            ],
            [
                'name'  => 'мазь'
            ],
            [
                'name'  => 'крем'
            ],
            [
                'name'  => 'паста'
            ],
            [
                'name'  => 'гель'
            ],
            [
                'name'  => 'ТТС'
            ],
            [
                'name'  => 'суппозитории'
            ],
            [
                'name'  => 'раствор'
            ],
            [
                'name'  => 'настойка'
            ],
            [
                'name'  => 'суспензия'
            ],
            [
                'name'  => 'эмульсия'
            ],
            [
                'name'  => 'капли'
            ],
            [
                'name'  => 'аэрозоль'
            ],
            [
                'name'  => 'сироп'
            ],
            [
                'name'  => 'микстура'
            ]
        ];

        DB::table('med_forms')->insert($data);
    }
}
