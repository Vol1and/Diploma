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
                'storage_id' => 1,
                'butch_number_connection_id' => 1,
                'characteristic_id' => 1,
                'change' => 0
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 1,
                'change' => 140
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 2,
                'change' => 200
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 3,
                'change' => 24
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 4,
                'change' => 50
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 5,
                'change' => 48
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 4,
                'change' => -20
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 5,
                'change' => -20
            ]
        ];

        DB::table('ware_connections')->insert($data);
    }
}
