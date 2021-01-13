<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class WareConnectionSeeder extends Seeder
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
                'characteristic_id' => 1,
                'change' => 140
            ],
            [
                'characteristic_id' => 2,
                'change' => 200
            ],
            [
                'characteristic_id' => 3,
                'change' => 24
            ],
            [
                'characteristic_id' => 4,
                'change' => 50
            ],
            [
                'characteristic_id' => 5,
                'change' => 48
            ]
        ];

        DB::table('ware_connections')->insert($data);
    }
}
