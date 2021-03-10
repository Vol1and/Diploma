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
                'change' => 0,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 11, 15, date("m"),   date("d") - 19,   date("Y")-40))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 1,
                'change' => 140,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 19,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 2,
                'change' => 200,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 19,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 3,
                'change' => 24,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 15, 12, date("m"),   date("d") - 19,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 4,
                'change' => 50,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 15, 12, date("m"),   date("d") - 19,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 5,
                'change' => 48,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 15, 12, date("m"),   date("d") - 19,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 4,
                'change' => -20,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 30, 12, date("m"),   date("d") - 19,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 5,
                'change' => -20,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 30, 12, date("m"),   date("d") - 19,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 1,
                'change' => -7,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 45, 45, date("m"),   date("d") - 18,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 3,
                'change' => -2,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 45, 45, date("m"),   date("d") - 18,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 5,
                'change' => -3,
                'created_at'=> date("Y-m-d H:i:s", mktime(9, 22, 12, date("m"),   date("d") - 18,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 5,
                'change' => -4,
                'created_at'=> date("Y-m-d H:i:s", mktime(9, 25, 12, date("m"),   date("d") - 18,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 1,
                'change' => -10,
                'created_at'=> date("Y-m-d H:i:s", mktime(9, 42, 22, date("m"),   date("d") - 18,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 2,
                'change' => -2,
                'created_at'=> date("Y-m-d H:i:s", mktime(9, 42, 22, date("m"),   date("d") - 18,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 4,
                'change' => -2,
                'created_at'=> date("Y-m-d H:i:s", mktime(9, 42, 22, date("m"),   date("d") - 18,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 3,
                'change' => -1,
                'created_at'=> date("Y-m-d H:i:s", mktime(9, 47, 33, date("m"),   date("d") - 18,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 4,
                'change' => -1,
                'created_at'=> date("Y-m-d H:i:s", mktime(9, 47, 33, date("m"),   date("d") - 18,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 1,
                'change' => -5,
                'created_at'=> date("Y-m-d H:i:s", mktime(10, 3, 15, date("m"),   date("d") - 18,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 1,
                'change' => -3,
                'created_at'=> date("Y-m-d H:i:s", mktime(10, 11, 12, date("m"),   date("d") - 18,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 5,
                'change' => -3,
                'created_at'=> date("Y-m-d H:i:s", mktime(10, 11, 12, date("m"),   date("d") - 18,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 2,
                'change' => -30,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 4, 55, date("m"),   date("d") - 17,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 1,
                'change' => -15,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 15, 40, date("m"),   date("d") - 17,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 3,
                'change' => -10,
                'created_at'=> date("Y-m-d H:i:s", mktime(9, 32, 27, date("m"),   date("d") - 17,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 1,
                'change' => -20,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 17, 22, date("m"),   date("d") - 16,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 2,
                'change' => -5,
                'created_at'=> date("Y-m-d H:i:s", mktime(9, 2, 3, date("m"),   date("d") - 16,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 4,
                'change' => -15,
                'created_at'=> date("Y-m-d H:i:s", mktime(9, 2, 3, date("m"),   date("d") - 16,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 3,
                'characteristic_id' => 5,
                'change' => -3,
                'created_at'=> date("Y-m-d H:i:s", mktime(9, 2, 3, date("m"),   date("d") - 16,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 2,
                'change' => -40,
                'created_at'=> date("Y-m-d H:i:s", mktime(9, 33, 44, date("m"),   date("d") - 16,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 1,
                'change' => -2,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 11, 11, date("m"),   date("d") - 15,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 2,
                'change' => -5,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 22, 6, date("m"),   date("d") - 15,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 2,
                'characteristic_id' => 2,
                'change' => -10,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 1, 16, date("m"),   date("d") - 14,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 4,
                'characteristic_id' => 6,
                'change' => 2000,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 14,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 4,
                'characteristic_id' => 7,
                'change' => 120,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 14,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 4,
                'characteristic_id' => 8,
                'change' => 96,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 14,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 4,
                'characteristic_id' => 9,
                'change' => 400,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 14,   date("Y")))
            ],
            [
                'storage_id' => 1,
                'butch_number_connection_id' => 4,
                'characteristic_id' => 1,
                'change' => 400,
                'created_at'=> date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 14,   date("Y")))
            ]
        ];

        DB::table('ware_connections')->insert($data);
    }
}
