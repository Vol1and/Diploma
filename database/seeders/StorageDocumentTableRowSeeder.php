<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class StorageDocumentTableRowSeeder extends Seeder
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
                'characteristic_id'  => 1,
                'storage_document_id'  => 1,
                'ware_connection_id' => 2,
                'price'  => 80,
                'count' => 7
            ],
            [
                'characteristic_id'  => 3,
                'storage_document_id'  => 1,
                'ware_connection_id' => 4,
                'price'  => 95,
                'count' => 2
            ]
        ];
        DB::table('storage_document_table_rows')->insert($data);
    }
}
