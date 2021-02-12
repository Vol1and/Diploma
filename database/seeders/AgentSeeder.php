<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AgentSeeder extends Seeder
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
                'name' => 'Не указан',
                'billing' => '',
                'address' => '',
                'description' => '',
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Медикодон',
                'billing' => 'ИКЮЛ: 60110215; КБК: 22011303010010000130; Номер счета: 40101810720000011001',
                'address' => 'г. Донецк, ул. Павших Коммунаров, 95Б',
                'description' => 'Оптовый дистрибьютор медикаментов в Донецке, менеджер Борис - 0952516126',
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Исида Фарм',
                'billing' => 'ИКЮЛ: 60112515; КБК: 22022313010010000135; Номер счета: 40102210120000011042',
                'address' => 'г. Донецк, ул. Прокофьева, 9',
                'description' => 'Оптовый дистрибьютор медикаментов в Донецке, менеджер Ульяна - 0622030380',
                'created_at' => Carbon::now(), 'updated_at' =>Carbon::now()
            ],
            [
                'name' => 'Реверс Прод',
                'billing' => 'ИКЮЛ: 60221214; КБК: 22011322034010000112; Номер счета: 40102211400000011234',
                'address' => 'г. Донецк, ул. Складская, 4В',
                'description' => 'Оптовый дистрибьютор минеральной воды и прочих товаров, менеджер Яна - 0507295121',
                'created_at' => Carbon::now(), 'updated_at' =>Carbon::now()
            ],
            [
                'name' => 'Аптека Медос №1',
                'billing' => 'ИКЮЛ: 60318832; КБК: 22044322034010000182; Номер счета: 40105511400000012148',
                'address' => 'г. Донецк, ул. Университетская, 112',
                'description' => 'Медос, аптека 1; заведующая Елена Константиновна - 0951121212',
                'created_at' => Carbon::now(), 'updated_at' =>Carbon::now()
            ],
            [
                'name' => 'Аптека Медос №2',
                'billing' => 'ИКЮЛ: 60318832; КБК: 22044322034010000182; Номер счета: 40105511400000012148',
                'address' => 'г. Донецк, ул. Артёма, 42',
                'description' => 'Медос, аптека 2; заведующая Инна Викторовна - 0662947298',
                'created_at' => Carbon::now(), 'updated_at' =>Carbon::now()
            ],
            [
                'name' => 'Аптека Медос №3',
                'billing' => 'ИКЮЛ: 60318832; КБК: 22044322034010000182; Номер счета: 40105511400000012148',
                'address' => 'г. Донецк, ул. Шевченко, 74',
                'description' => 'Медос, аптека 3; заведующая Оксана Сергеевна - 0502817581',
                'created_at' => Carbon::now(), 'updated_at' =>Carbon::now()
            ],
            [
                'name' => 'Аптека Медос №4',
                'billing' => 'ИКЮЛ: 60318832; КБК: 22044322034010000182; Номер счета: 40105511400000012148',
                'address' => 'г. Донецк, ул. Шахтостроителей, 20',
                'description' => 'Медос, аптека 4; заведующая Нина Алексеевна - 0669928162',
                'created_at' => Carbon::now(), 'updated_at' =>Carbon::now()
            ],
            [
                'name' => 'Аптека Медос №5',
                'billing' => 'ИКЮЛ: 60318832; КБК: 22044322034010000182; Номер счета: 40105511400000012148',
                'address' => 'г. Макеевка, ул. Ленина, 54',
                'description' => 'Медос, аптека 5; заведующая Лариса Александровна - 0665838212',
                'created_at' => Carbon::now(), 'updated_at' =>Carbon::now()
            ],
            [
                'name' => 'Реализация товара',
                'billing' => 'ИКЮЛ: 60318832; КБК: 22044322034010000182; Номер счета: 40105511400000012148',
                'address' => 'г. Донецк, ул. Университетская, 112',
                'description' => 'Медос, аптека 1; заведующая Елена Константиновна - 0951121212',
                'created_at' => Carbon::now(), 'updated_at' =>Carbon::now()
            ]
        ];

        DB::table('agents')->insert($data);
    }
}
