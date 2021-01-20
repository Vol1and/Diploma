<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DocConnectionSeeder extends Seeder
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
                'table_id'=> 1,
                'document_id'  => 1,
                'price'  => 80,
                'count' => 140
            ],
            [
                'characteristic_id'  => 2,
                'table_id'=> 2,
                'document_id'  => 1,
                'price'  => 45,
                'count' => 200
            ],
            [
                'characteristic_id'  => 3,
                'table_id'=> 3,
                'document_id'  => 2,
                'price'  => 95,
                'count' => 24
            ],
            [
                'characteristic_id'  => 4,
                'table_id'=> 1,
                'document_id'  => 2,
                'price'  => 75,
                'count' => 50
            ],
            [
                'characteristic_id'  => 5,
                'table_id'=> 2,
                'document_id'  => 2,
                'price'  => 99,
                'count' => 48
            ]
        ];

        DB::table('doc_connections')->insert($data);
    }
}
