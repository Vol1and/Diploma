<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class BarcodeConnectionSeeder extends Seeder
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
                'nomenclature_id' => 857,
                'barcode_id' => 1,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 30, 12, date("m"),   date("d") - 19,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'nomenclature_id' => 216,
                'barcode_id' => 2,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 1, 16, date("m"),   date("d") - 14,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'nomenclature_id' => 140,
                'barcode_id' => 3,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 1, 16, date("m"),   date("d") - 14,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'nomenclature_id' => 142,
                'barcode_id' => 4,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 1, 16, date("m"),   date("d") - 14,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'nomenclature_id' => 662,
                'barcode_id' => 5,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 1, 16, date("m"),   date("d") - 14,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'nomenclature_id' => 666,
                'barcode_id' => 6,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 1, 16, date("m"),   date("d") - 14,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'nomenclature_id' => 810,
                'barcode_id' => 7,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 1, 16, date("m"),   date("d") - 14,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'nomenclature_id' => 461,
                'barcode_id' => 8,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 1, 16, date("m"),   date("d") - 14,   date("Y"))),
                'updated_at' => Carbon::now()
            ]
        ];

        DB::table('barcode_connections')->insert($data);
    }
}
