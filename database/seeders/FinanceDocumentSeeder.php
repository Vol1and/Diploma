<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class FinanceDocumentSeeder extends Seeder
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
                'date' => date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 1,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 1,
                'agent_id' => 2,
                'storage_id' => 1,
                'comment' => 'Комментарий №1',
                'doc_sum' =>19400
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 15, 12, date("m"),   date("d") - 1,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 1,
                'agent_id' => 3,
                'storage_id' => 1,
                'comment' => 'Комментарий №2',
                'doc_sum' =>10782
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 30, 12, date("m"),   date("d") - 1,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №1',
                'doc_sum' =>1
            ]
        ];

        DB::table('finance_documents')->insert($data);
    }
}
