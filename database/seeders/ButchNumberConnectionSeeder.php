<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class ButchNumberConnectionSeeder extends Seeder
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
                'butch_number' => 0
            ],
            [
                'butch_number' => 1
            ],
            [
                'butch_number' => 2
            ]
        ];

        DB::table('butch_number_connections')->insert($data);
    }
}