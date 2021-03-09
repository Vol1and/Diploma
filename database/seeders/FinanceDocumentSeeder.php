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
                'date' => date("Y-m-d H:i:s", mktime(8, 11, 15, date("m"),   date("d") - 19,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 7,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Финансовая помощь',
                'doc_sum' =>1000000
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 19,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 1,
                'agent_id' => 2,
                'storage_id' => 1,
                'comment' => 'Комментарий №1',
                'doc_sum' =>19400
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 15, 12, date("m"),   date("d") - 19,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 1,
                'agent_id' => 3,
                'storage_id' => 1,
                'comment' => 'Комментарий №2',
                'doc_sum' =>10782
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 30, 12, date("m"),   date("d") - 19,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №1',
                'doc_sum' => 13500
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 22, 12, date("m"),   date("d") - 18,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №2',
                'doc_sum' => 885
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 25, 12, date("m"),   date("d") - 18,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №3',
                'doc_sum' => 1180
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 42, 22, date("m"),   date("d") - 18,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №4',
                'doc_sum' => 2000
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 47, 33, date("m"),   date("d") - 18,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №5',
                'doc_sum' => 1030
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(10, 3, 15, date("m"),   date("d") - 18,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №6',
                'doc_sum' => 500
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(10, 11, 12, date("m"),   date("d") - 18,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №7',
                'doc_sum' => 1185
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 4, 55, date("m"),   date("d") - 17,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №8',
                'doc_sum' => 3600
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 15, 40, date("m"),   date("d") - 17,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №9',
                'doc_sum' => 1500
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 32, 27, date("m"),   date("d") - 17,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №10',
                'doc_sum' => 6500
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 17, 22, date("m"),   date("d") - 16,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №11',
                'doc_sum' => 2000
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 2, 3, date("m"),   date("d") - 16,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №12',
                'doc_sum' => 7185
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(9, 33, 44, date("m"),   date("d") - 16,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №13',
                'doc_sum' => 4800
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 11, 11, date("m"),   date("d") - 15,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №14',
                'doc_sum' => 200
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 22, 6, date("m"),   date("d") - 15,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №15',
                'doc_sum' => 600
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 1, 16, date("m"),   date("d") - 14,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 2,
                'agent_id' => 1,
                'storage_id' => 1,
                'comment' => 'Реализация №16',
                'doc_sum' => 1200
            ],
            [
                'date' => date("Y-m-d H:i:s", mktime(8, 12, 15, date("m"),   date("d") - 14,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 1,
                'agent_id' => 2,
                'storage_id' => 1,
                'comment' => 'Поступление №3',
                'doc_sum' =>102440
            ]
        ];

        DB::table('finance_documents')->insert($data);
    }
}
