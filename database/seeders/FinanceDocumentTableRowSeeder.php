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
            [
                'characteristic_id'  => 5,
                'finance_document_id'  => 5,
                'ware_connection_id' => 11,
                'price'  => 295,
                'count' => 3
            ],
            [
                'characteristic_id'  => 5,
                'finance_document_id'  => 6,
                'ware_connection_id' => 12,
                'price'  => 295,
                'count' => 4
            ],
            [
                'characteristic_id'  => 1,
                'finance_document_id'  => 7,
                'ware_connection_id' => 13,
                'price'  => 100,
                'count' => 10
            ],
            [
                'characteristic_id'  => 2,
                'finance_document_id'  => 7,
                'ware_connection_id' => 14,
                'price'  => 120,
                'count' => 2
            ],
            [
                'characteristic_id'  => 4,
                'finance_document_id'  => 7,
                'ware_connection_id' => 15,
                'price'  => 380,
                'count' => 2
            ],
            [
                'characteristic_id'  => 3,
                'finance_document_id'  => 8,
                'ware_connection_id' => 16,
                'price'  => 650,
                'count' => 1
            ],
            [
                'characteristic_id'  => 4,
                'finance_document_id'  => 8,
                'ware_connection_id' => 17,
                'price'  => 380,
                'count' => 1
            ],
            [
                'characteristic_id'  => 1,
                'finance_document_id'  => 9,
                'ware_connection_id' => 18,
                'price'  => 100,
                'count' => 5
            ],
            [
                'characteristic_id'  => 1,
                'finance_document_id'  => 10,
                'ware_connection_id' => 19,
                'price'  => 100,
                'count' => 3
            ],
            [
                'characteristic_id'  => 5,
                'finance_document_id'  => 10,
                'ware_connection_id' => 20,
                'price'  => 295,
                'count' => 3
            ],
            [
                'characteristic_id'  => 2,
                'finance_document_id'  => 11,
                'ware_connection_id' => 21,
                'price'  => 120,
                'count' => 30
            ],
            [
                'characteristic_id'  => 1,
                'finance_document_id'  => 12,
                'ware_connection_id' => 22,
                'price'  => 100,
                'count' => 15
            ],
            [
                'characteristic_id'  => 3,
                'finance_document_id'  => 13,
                'ware_connection_id' => 23,
                'price'  => 650,
                'count' => 10
            ],
            [
                'characteristic_id'  => 1,
                'finance_document_id'  => 14,
                'ware_connection_id' => 24,
                'price'  => 100,
                'count' => 20
            ],
            [
                'characteristic_id'  => 2,
                'finance_document_id'  => 15,
                'ware_connection_id' => 25,
                'price'  => 120,
                'count' => 5
            ],
            [
                'characteristic_id'  => 4,
                'finance_document_id'  => 15,
                'ware_connection_id' => 26,
                'price'  => 380,
                'count' => 15
            ],
            [
                'characteristic_id'  => 5,
                'finance_document_id'  => 15,
                'ware_connection_id' => 27,
                'price'  => 295,
                'count' => 3
            ],
            [
                'characteristic_id'  => 2,
                'finance_document_id'  => 16,
                'ware_connection_id' => 28,
                'price'  => 120,
                'count' => 40
            ],
            [
                'characteristic_id'  => 1,
                'finance_document_id'  => 17,
                'ware_connection_id' => 29,
                'price'  => 100,
                'count' => 2
            ],
            [
                'characteristic_id'  => 2,
                'finance_document_id'  => 18,
                'ware_connection_id' => 30,
                'price'  => 120,
                'count' => 5
            ],
            [
                'characteristic_id'  => 2,
                'finance_document_id'  => 19,
                'ware_connection_id' => 31,
                'price'  => 120,
                'count' => 10
            ],
            [
                'characteristic_id'  => 6,
                'finance_document_id'  => 20,
                'ware_connection_id' => 32,
                'price'  => 8,
                'count' => 2000
            ],
            [
                'characteristic_id'  => 7,
                'finance_document_id'  => 20,
                'ware_connection_id' => 33,
                'price'  => 165,
                'count' => 120
            ],
            [
                'characteristic_id'  => 8,
                'finance_document_id'  => 20,
                'ware_connection_id' => 34,
                'price'  => 215,
                'count' => 96
            ],
            [
                'characteristic_id'  => 9,
                'finance_document_id'  => 20,
                'ware_connection_id' => 35,
                'price'  => 35,
                'count' => 400
            ],
            [
                'characteristic_id'  => 1,
                'finance_document_id'  => 20,
                'ware_connection_id' => 36,
                'price'  => 80,
                'count' => 400
            ],
            [
                'characteristic_id'  => 1,
                'finance_document_id'  => 21,
                'ware_connection_id' => 37,
                'price'  => 100,
                'count' => 5
            ],
            [
                'characteristic_id'  => 9,
                'finance_document_id'  => 22,
                'ware_connection_id' => 38,
                'price'  => 50,
                'count' => 20
            ],
            [
                'characteristic_id'  => 8,
                'finance_document_id'  => 22,
                'ware_connection_id' => 39,
                'price'  => 250,
                'count' => 10
            ],
            [
                'characteristic_id'  => 7,
                'finance_document_id'  => 22,
                'ware_connection_id' => 40,
                'price'  => 210,
                'count' => 5
            ],
            [
                'characteristic_id'  => 6,
                'finance_document_id'  => 23,
                'ware_connection_id' => 41,
                'price'  => 10,
                'count' => 50
            ],
            [
                'characteristic_id'  => 1,
                'finance_document_id'  => 24,
                'ware_connection_id' => 42,
                'price'  => 100,
                'count' => 50
            ],
            [
                'characteristic_id'  => 8,
                'finance_document_id'  => 25,
                'ware_connection_id' => 43,
                'price'  => 250,
                'count' => 50
            ],
            [
                'characteristic_id'  => 9,
                'finance_document_id'  => 26,
                'ware_connection_id' => 44,
                'price'  => 50,
                'count' => 200
            ],
            [
                'characteristic_id'  => 7,
                'finance_document_id'  => 27,
                'ware_connection_id' => 45,
                'price'  => 210,
                'count' => 70
            ],
            [
                'characteristic_id'  => 9,
                'finance_document_id'  => 28,
                'ware_connection_id' => 46,
                'price'  => 50,
                'count' => 100
            ],
            [
                'characteristic_id'  => 1,
                'finance_document_id'  => 29,
                'ware_connection_id' => 47,
                'price'  => 100,
                'count' => 150
            ],
            [
                'characteristic_id'  => 2,
                'finance_document_id'  => 30,
                'ware_connection_id' => 48,
                'price'  => 120,
                'count' => 100
            ],
            [
                'characteristic_id'  => 5,
                'finance_document_id'  => 31,
                'ware_connection_id' => 49,
                'price'  => 295,
                'count' => 10
            ],
            [
                'characteristic_id'  => 6,
                'finance_document_id'  => 32,
                'ware_connection_id' => 50,
                'price'  => 10,
                'count' => 200
            ],
            [
                'characteristic_id'  => 7,
                'finance_document_id'  => 33,
                'ware_connection_id' => 51,
                'price'  => 210,
                'count' => 15
            ],
            [
                'characteristic_id'  => 7,
                'finance_document_id'  => 34,
                'ware_connection_id' => 52,
                'price'  => 210,
                'count' => 25
            ],
            [
                'characteristic_id'  => 8,
                'finance_document_id'  => 35,
                'ware_connection_id' => 53,
                'price'  => 250,
                'count' => 20
            ],
            [
                'characteristic_id'  => 9,
                'finance_document_id'  => 36,
                'ware_connection_id' => 54,
                'price'  => 50,
                'count' => 40
            ]
        ];

        DB::table('finance_document_table_rows')->insert($data);
    }
}
