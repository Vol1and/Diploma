<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
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
                'date' => date("Y-m-d", mktime(0, 0, 0, date("m"),   date("d") - 1,   date("Y"))),
                'doc_type_id'  => 1,
                'agent_id' => 2
            ],
            [
                'date' => date("Y-m-d", mktime(0, 0, 0, date("m"),   date("d") - 1,   date("Y"))),
                'doc_type_id'  => 1,
                'agent_id' => 1
            ]
        ];

        DB::table('documents')->insert($data);
    }
}