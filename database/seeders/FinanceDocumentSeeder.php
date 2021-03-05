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
                'date' => date("Y-m-d H:i:s", mktime(8, 11, 15, date("m"),   date("d") - 3,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 7,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Финансовая помощь',
                'doc_sum' =>1000000
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 3,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 1,
                'agent_id' => 2,
                'storage_id' => 1,
                'comment' => 'Комментарий №1',
                'doc_sum' =>19400
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 15, 12, date("m"),   date("d") - 3,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 1,
                'agent_id' => 3,
                'storage_id' => 1,
                'comment' => 'Комментарий №2',
                'doc_sum' =>10782
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 30, 12, date("m"),   date("d") - 3,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №1',
                'doc_sum' => 13500
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 22, 12, date("m"),   date("d") - 2,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №2',
                'doc_sum' => 885
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 25, 12, date("m"),   date("d") - 2,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №3',
                'doc_sum' => 1180
            ]
        ];

        DB::table('finance_documents')->insert($data);
    }
}
