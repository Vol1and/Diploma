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
                'document_id'  => 1,
                'price'  => 80,
                'amount' => 140
            ],
            [
                'characteristic_id'  => 2,
                'document_id'  => 1,
                'price'  => 45,
                'amount' => 200
            ],
            [
                'characteristic_id'  => 3,
                'document_id'  => 2,
                'price'  => 95,
                'amount' => 24
            ],
            [
                'characteristic_id'  => 4,
                'document_id'  => 2,
                'price'  => 75,
                'amount' => 50
            ],
            [
                'characteristic_id'  => 5,
                'document_id'  => 2,
                'price'  => 99,
                'amount' => 48
            ]
        ];

        DB::table('doc_connections')->insert($data);
    }
}
