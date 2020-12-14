<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class WareSeeder extends Seeder
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
                'characteristic_id'  => 1,
                'stock' => 140
            ],
            [
                'characteristic_id'  => 2,
                'stock' => 200
            ],
            [
                'characteristic_id'  => 3,
                'stock' => 24
            ],
            [
                'characteristic_id'  => 4,
                'stock' => 50
            ],
            [
                'characteristic_id'  => 5,
                'stock' => 48
            ]
        ];

        DB::table('wares')->insert($data);
    }
}
