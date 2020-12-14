<?php


namespace Database\Seeders;


use DB;
use Illuminate\Database\Seeder;

class CharacteristicSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'serial'      => 'ТА291821',
                'expiry_date' => date("Y-m-d", mktime(0, 0, 0, date("m")+4,   date("d"),   date("Y")+2)),
                'export'      => 100,
                'nomenclature_id'     => 1,
                'created_at'  => date("Y-m-d H:i:s"),
                'updated_at'  => date("Y-m-d H:i:s")
            ],
            [
                'serial'      => 'КЛ2088',
                'expiry_date' => date("Y-m-d", mktime(0, 0, 0, date("m")+3,   date("d"),   date("Y")+1)),
                'export'      => 120,
                'nomenclature_id'     => 2,
                'created_at'  => date("Y-m-d H:i:s"),
                'updated_at'  => date("Y-m-d H:i:s")
            ],
            [
                'serial'      => 'JG2971',
                'expiry_date' => date("Y-m-d", mktime(0, 0, 0, date("m")+7,   date("d"),   date("Y")+1)),
                'export'      => 650,
                'nomenclature_id'     => 3,
                'created_at'  => date("Y-m-d H:i:s"),
                'updated_at'  => date("Y-m-d H:i:s")
            ],
            [
                'serial'      => 'KT29271',
                'expiry_date' => date("Y-m-d", mktime(0, 0, 0, date("m")+3,   date("d"),   date("Y")+2)),
                'export'      => 380,
                'nomenclature_id'     => 4,
                'created_at'  => date("Y-m-d H:i:s"),
                'updated_at'  => date("Y-m-d H:i:s")
            ],
            [
                'serial'      => 'FA295912',
                'expiry_date'      => date("Y-m-d", mktime(0, 0, 0, date("m")+7,   date("d"),   date("Y")+2)),
                'export'      => 295,
                'nomenclature_id'     => 5,
                'created_at'  => date("Y-m-d H:i:s"),
                'updated_at'  => date("Y-m-d H:i:s")
            ]
        ];

        DB::table('characteristics')->insert($data);
    }
}
