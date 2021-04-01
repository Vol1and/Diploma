<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class BarcodeSeeder extends Seeder
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
                'code' => "4601811011047"
            ],
            [
                'code' => "4250369506323"
            ],
            [
                'code' => "0000000000003"
            ],
            [
                'code' => "0000000000004"
            ],
            [
                'code' => "0000000000005"
            ],
            [
                'code' => "0000000000006"
            ],
            [
                'code' => "0000000000007"
            ],
            [
                'code' => "0000000000008"
            ]
        ];

        DB::table('barcodes')->insert($data);
    }
}
