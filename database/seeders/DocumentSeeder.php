<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
                'date' =>  Carbon::now(),
                'is_set'  => true,
                'doc_type_id'  => 1,
                'agent_id' => 2,
                'storage_id' => 1
            ],
            [
                'date' => Carbon::now(),
                'is_set'  => true,
                'doc_type_id'  => 1,
                'agent_id' => 1,
                'storage_id' => 1
            ]
        ];

        DB::table('documents')->insert($data);
    }
}
