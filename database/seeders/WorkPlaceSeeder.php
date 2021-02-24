<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class WorkPlaceSeeder extends Seeder
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
                'name' => 'Склад: 1; Касса: 1',
                'is_opened' => false,
                'storage_id' => 1,
                'last_access' => date("Y-m-d", mktime(19, 59, 59, date("m"),   date("d")-1,   date("Y")))

            ],
            [
                'name' => 'Склад: 1; Касса: 2',
                'is_opened' => false,
                'storage_id' => 1,
                'last_access' => date("Y-m-d", mktime(19, 59, 59, date("m"),   date("d")-1,   date("Y")))
            ],
            [
                'name' => 'Склад: 1; Касса: 3',
                'is_opened' => false,
                'storage_id' => 1,
                'last_access' => date("Y-m-d", mktime(19, 59, 59, date("m"),   date("d")-1,   date("Y")))
            ],
            [
                'name' => 'Склад: 2; Касса: 1',
                'is_opened' => false,
                'storage_id' => 2,
                'last_access' => date("Y-m-d", mktime(19, 59, 59, date("m"),   date("d")-1,   date("Y")))
            ],
            [
                'name' => 'Склад: 2; Касса: 2',
                'is_opened' => false,
                'storage_id' => 2,
                'last_access' => date("Y-m-d", mktime(19, 59, 59, date("m"),   date("d")-1,   date("Y")))
            ]
        ];

        DB::table('workplaces')->insert($data);
    }
}
