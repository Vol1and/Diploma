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
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 1,
                'change' => -7
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 3,
                'change' => -2
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 5,
                'change' => -3
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 5,
                'change' => -4
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 1,
                'change' => -10
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 2,
                'change' => -2
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 4,
                'change' => -2
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 3,
                'change' => -1
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 4,
                'change' => -1
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 1,
                'change' => -5
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 1,
                'change' => -3
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 5,
                'change' => -3
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 2,
                'change' => -30
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 1,
                'change' => -15
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 3,
                'change' => -10
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 1,
                'change' => -20
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 2,
                'change' => -5
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 4,
                'change' => -15
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 5,
                'change' => -3
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 2,
                'change' => -40
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 1,
                'change' => -2
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 2,
                'change' => -5
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 2,
                'change' => -10
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 4,
                'characteristic_id' => 6,
                'change' => 2000
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 4,
                'characteristic_id' => 7,
                'change' => 120
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 4,
                'characteristic_id' => 8,
                'change' => 96
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 4,
                'characteristic_id' => 9,
                'change' => 400
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 4,
                'characteristic_id' => 1,
                'change' => 400
            ]
        ];

        DB::table('ware_connections')->insert($data);
    }
}
