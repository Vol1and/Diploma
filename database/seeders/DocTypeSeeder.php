<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DocTypeSeeder extends Seeder
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
                'name'  => 'Поступление',
                'is_income' => true
            ],
            [
                'name'  => 'Реализация',
                'is_income' => false
            ],
            [
                'name'  => 'Списание',
                'is_income' => false
            ]
        ];

        DB::table('doc_types')->insert($data);
    }
}
