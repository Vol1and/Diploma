<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class StorageDocumentSeeder extends Seeder
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
                'date' => date("Y-m-d H:i:s", mktime(8, 45, 45, date("m"),   date("d") - 18,   date("Y"))),
                'is_set'  => true,
                'doc_type_id'  => 3,
                'source_storage_id' => 1,
                'destination_storage_id' => 0,
                'comment' => 'Списание №1: Испорченные упаковки',
                'doc_sum' => 2000
            ]
        ];

        DB::table('storage_documents')->insert($data);
    }
}
