<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class FinanceDocumentTableRowSeeder extends Seeder
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
                'finance_document_id'  => 2,
                'ware_connection_id' => 2,
                'price'  => 80,
                'count' => 140
            ],
            [
                'characteristic_id'  => 2,
                'finance_document_id'  => 2,
                'ware_connection_id' => 3,
                'price'  => 45,
                'count' => 200
            ],
            [
                'characteristic_id'  => 3,
                'finance_document_id'  => 3,
                'ware_connection_id' => 4,
                'price'  => 95,
                'count' => 24
            ],
            [
                'characteristic_id'  => 4,
                'finance_document_id'  => 3,
                'ware_connection_id' => 5,
                'price'  => 75,
                'count' => 50
            ],
            [
                'characteristic_id'  => 5,
                'finance_document_id'  => 3,
                'ware_connection_id' => 6,
                'price'  => 99,
                'count' => 48
            ],
            [
                'characteristic_id'  => 4,
                'finance_document_id'  => 4,
                'ware_connection_id' => 7,
                'price'  => 380,
                'count' => 20
            ],
            [
                'characteristic_id'  => 5,
                'finance_document_id'  => 4,
                'ware_connection_id' => 8,
                'price'  => 295,
                'count' => 20
            ],
        ];

        DB::table('finance_document_table_rows')->insert($data);
    }
}
