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
                'date' => date("Y-m-d H:i:s", mktime(8, 11, 15, date("m"),   date("d") - 3,   date("Y"))),
                'document_id' => 1,
                'change' => 1000000
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 3,   date("Y"))),
                'document_id' => 2,
                'change' => -19400
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 15, 12, date("m"),   date("d") - 3,   date("Y"))),
                'document_id' => 3,
                'change' => -10782
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 30, 12, date("m"),   date("d") - 3,   date("Y"))),
                'document_id' => 4,
                'change' => 13500
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 22, 12, date("m"),   date("d") - 2,   date("Y"))),
                'document_id' => 5,
                'change' => 885
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 25, 12, date("m"),   date("d") - 2,   date("Y"))),
                'document_id' => 5,
                'change' => 1180
            ]
        ];

        DB::table('accounting_connections')->insert($data);
    }
}
