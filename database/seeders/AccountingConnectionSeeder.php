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
            ]
        ];

        DB::table('accounting_connections')->insert($data);
    }
}
