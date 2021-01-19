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
                'is_set'  => true,
                'doc_type_id'  => 1,
                'agent_id' => 2,
                'storage_id' => 1
            ],
            [
                'date' => date("Y-m-d", mktime(0, 0, 0, date("m"),   date("d") - 1,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 1,
                'agent_id' => 1,
                'storage_id' => 1
            ]
        ];

        DB::table('documents')->insert($data);
    }
}
