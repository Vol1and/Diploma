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
            ]
        ];

        DB::table('workplace_document_connections')->insert($data);
    }
}
