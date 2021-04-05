<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class WorkplaceDocumentConnectionSeeder extends Seeder
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
                'workplace_id' => 1,
                'document_id' => 4,
                'user_id' => 2,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 30, 12, date("m"),   date("d") - 19,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 1,
                'document_id' => 5,
                'user_id' => 2,
                'created_at' => date("Y-m-d H:i:s", mktime(9, 22, 12, date("m"),   date("d") - 18,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 2,
                'document_id' => 6,
                'user_id' => 3,
                'created_at' => date("Y-m-d H:i:s", mktime(9, 25, 12, date("m"),   date("d") - 18,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 3,
                'document_id' => 7,
                'user_id' => 4,
                'created_at' => date("Y-m-d H:i:s", mktime(9, 42, 22, date("m"),   date("d") - 18,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 2,
                'document_id' => 9,
                'user_id' => 3,
                'created_at' => date("Y-m-d H:i:s", mktime(10, 3, 15, date("m"),   date("d") - 18,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 2,
                'document_id' => 10,
                'user_id' => 3,
                'created_at' => date("Y-m-d H:i:s", mktime(10, 11, 12, date("m"),   date("d") - 18,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 3,
                'document_id' => 11,
                'user_id' => 4,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 4, 55, date("m"),   date("d") - 17,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 3,
                'document_id' => 12,
                'user_id' => 4,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 15, 40, date("m"),   date("d") - 17,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 2,
                'document_id' => 13,
                'user_id' => 3,
                'created_at' => date("Y-m-d H:i:s", mktime(9, 32, 27, date("m"),   date("d") - 17,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 1,
                'document_id' => 14,
                'user_id' => 2,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 17, 22, date("m"),   date("d") - 16,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 2,
                'document_id' => 15,
                'user_id' => 3,
                'created_at' => date("Y-m-d H:i:s", mktime(9, 2, 3, date("m"),   date("d") - 16,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 2,
                'document_id' => 16,
                'user_id' => 3,
                'created_at' => date("Y-m-d H:i:s", mktime(9, 33, 44, date("m"),   date("d") - 16,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 3,
                'document_id' => 17,
                'user_id' => 4,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 11, 11, date("m"),   date("d") - 15,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 3,
                'document_id' => 18,
                'user_id' => 4,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 22, 6, date("m"),   date("d") - 15,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 1,
                'document_id' => 19,
                'user_id' => 2,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 1, 16, date("m"),   date("d") - 14,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 1,
                'document_id' => 21,
                'user_id' => 2,
                'created_at' => date("Y-m-d H:i:s", mktime(9, 12, 16, date("m"),   date("d") - 14,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 3,
                'document_id' => 22,
                'user_id' => 4,
                'created_at' => date("Y-m-d H:i:s", mktime(9, 42, 16, date("m"),   date("d") - 14,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 3,
                'document_id' => 23,
                'user_id' => 4,
                'created_at' => date("Y-m-d H:i:s", mktime(10, 11, 33, date("m"),   date("d") - 14,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 2,
                'document_id' => 24,
                'user_id' => 3,
                'created_at' => date("Y-m-d H:i:s", mktime(9, 11, 22, date("m"),   date("d") - 13,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 2,
                'document_id' => 25,
                'user_id' => 3,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 41, 55, date("m"),   date("d") - 12,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 1,
                'document_id' => 26,
                'user_id' => 2,
                'created_at' => date("Y-m-d H:i:s", mktime(11, 12, 13, date("m"),   date("d") - 11,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 1,
                'document_id' => 27,
                'user_id' => 2,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 27, 11, date("m"),   date("d") - 10,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 1,
                'document_id' => 28,
                'user_id' => 2,
                'created_at' => date("Y-m-d H:i:s", mktime(12, 11, 44, date("m"),   date("d") - 9,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 2,
                'document_id' => 29,
                'user_id' => 3,
                'created_at' => date("Y-m-d H:i:s", mktime(10, 15, 11, date("m"),   date("d") - 8,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 3,
                'document_id' => 30,
                'user_id' => 4,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 15, 33, date("m"),   date("d") - 7,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 3,
                'document_id' => 31,
                'user_id' => 4,
                'created_at' => date("Y-m-d H:i:s", mktime(11, 11, 22, date("m"),   date("d") - 6,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 1,
                'document_id' => 32,
                'user_id' => 2,
                'created_at' => date("Y-m-d H:i:s", mktime(9, 5, 44, date("m"),   date("d") - 5,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 1,
                'document_id' => 33,
                'user_id' => 2,
                'created_at' => date("Y-m-d H:i:s", mktime(15, 12, 11, date("m"),   date("d") - 4,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 2,
                'document_id' => 34,
                'user_id' => 3,
                'created_at' => date("Y-m-d H:i:s", mktime(11, 12, 11, date("m"),   date("d") - 3,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 2,
                'document_id' => 35,
                'user_id' => 3,
                'created_at' => date("Y-m-d H:i:s", mktime(8, 44, 55, date("m"),   date("d") - 2,   date("Y"))),
                'updated_at' => Carbon::now()
            ],
            [
                'workplace_id' => 3,
                'document_id' => 36,
                'user_id' => 4,
                'created_at' => date("Y-m-d H:i:s", mktime(13, 13, 13, date("m"),   date("d") - 1,   date("Y"))),
                'updated_at' => Carbon::now()
            ]
        ];

        DB::table('workplace_document_connections')->insert($data);
    }
}
