<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $storages = [

            [
                'name' => 'Склад №1',
                'created_at' => date("Y-m-d H:i:s", mktime(8, 11, 15, date("m"),   date("d") - 20,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Склад №2',
                'created_at' => date("Y-m-d H:i:s", mktime(8, 11, 15, date("m"),   date("d") - 20,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Склад №3',
                'created_at' => date("Y-m-d H:i:s", mktime(8, 11, 15, date("m"),   date("d") - 20,   date("Y"))),
                'updated_at' => Carbon::now()
            ]
        ];
        \DB::table('storages')->insert($storages);
    }
}
