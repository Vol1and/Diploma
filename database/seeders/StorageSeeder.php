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

            ['name' => 'Склад №1',     'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Склад №2',     'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ];
        \DB::table('storages')->insert($storages);
    }
}
