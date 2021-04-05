<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class AccountingConnectionSeeder extends Seeder
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
                'date' => date("Y-m-d H:i:s", mktime(8, 11, 15, date("m"),   date("d") - 19,   date("Y"))),
                'document_id' => 1,
                'change' => 1000000
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 19,   date("Y"))),
                'document_id' => 2,
                'change' => -19400
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 15, 12, date("m"),   date("d") - 19,   date("Y"))),
                'document_id' => 3,
                'change' => -10782
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 30, 12, date("m"),   date("d") - 19,   date("Y"))),
                'document_id' => 4,
                'change' => 13500
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 22, 12, date("m"),   date("d") - 18,   date("Y"))),
                'document_id' => 5,
                'change' => 885
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 25, 12, date("m"),   date("d") - 18,   date("Y"))),
                'document_id' => 6,
                'change' => 1180
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 42, 22, date("m"),   date("d") - 18,   date("Y"))),
                'document_id' => 7,
                'change' => 2000
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 47, 33, date("m"),   date("d") - 18,   date("Y"))),
                'document_id' => 8,
                'change' => 1030
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(10, 3, 15, date("m"),   date("d") - 18,   date("Y"))),
                'document_id' => 9,
                'change' => 500
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 4, 55, date("m"),   date("d") - 17,   date("Y"))),
                'document_id' => 10,
                'change' => 1185
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 4, 55, date("m"),   date("d") - 17,   date("Y"))),
                'document_id' => 11,
                'change' => 3600
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 15, 40, date("m"),   date("d") - 17,   date("Y"))),
                'document_id' => 12,
                'change' => 1500
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 32, 27, date("m"),   date("d") - 17,   date("Y"))),
                'document_id' => 13,
                'change' => 6500
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 17, 22, date("m"),   date("d") - 16,   date("Y"))),
                'document_id' => 14,
                'change' => 2000
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 2, 3, date("m"),   date("d") - 16,   date("Y"))),
                'document_id' => 15,
                'change' => 7185
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 33, 44, date("m"),   date("d") - 16,   date("Y"))),
                'document_id' => 16,
                'change' => 4800
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 11, 11, date("m"),   date("d") - 15,   date("Y"))),
                'document_id' => 17,
                'change' => 200
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 22, 6, date("m"),   date("d") - 15,   date("Y"))),
                'document_id' => 18,
                'change' => 600
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 1, 16, date("m"),   date("d") - 14,   date("Y"))),
                'document_id' => 19,
                'change' => 1200
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 14,   date("Y"))),
                'document_id' => 20,
                'change' => -102440
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 12, 16, date("m"),   date("d") - 14,   date("Y"))),
                'document_id' => 21,
                'change' => 500
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 42, 16, date("m"),   date("d") - 14,   date("Y"))),
                'document_id' => 22,
                'change' => 4550
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(10, 11, 33, date("m"),   date("d") - 14,   date("Y"))),
                'document_id' => 23,
                'change' => 500
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 11, 22, date("m"),   date("d") - 13,   date("Y"))),
                'document_id' => 24,
                'change' => 5000
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 41, 55, date("m"),   date("d") - 12,   date("Y"))),
                'document_id' => 25,
                'change' => 12500
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(11, 12, 13, date("m"),   date("d") - 11,   date("Y"))),
                'document_id' => 26,
                'change' => 10000
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 27, 11, date("m"),   date("d") - 10,   date("Y"))),
                'document_id' => 27,
                'change' => 14700
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(12, 11, 44, date("m"),   date("d") - 9,   date("Y"))),
                'document_id' => 28,
                'change' => 5000
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(10, 15, 11, date("m"),   date("d") - 8,   date("Y"))),
                'document_id' => 29,
                'change' => 15000
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 15, 33, date("m"),   date("d") - 7,   date("Y"))),
                'document_id' => 30,
                'change' => 12000
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(11, 11, 22, date("m"),   date("d") - 6,   date("Y"))),
                'document_id' => 31,
                'change' => 2950
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 5, 44, date("m"),   date("d") - 5,   date("Y"))),
                'document_id' => 32,
                'change' => 2000
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(15, 12, 11, date("m"),   date("d") - 4,   date("Y"))),
                'document_id' => 33,
                'change' => 3150
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(11, 12, 11, date("m"),   date("d") - 3,   date("Y"))),
                'document_id' => 34,
                'change' => 5250
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 44, 55, date("m"),   date("d") - 2,   date("Y"))),
                'document_id' => 35,
                'change' => 5000
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(13, 13, 13, date("m"),   date("d") - 1,   date("Y"))),
                'document_id' => 36,
                'change' => 2000
            ]
        ];

        DB::table('accounting_connections')->insert($data);
    }
}
