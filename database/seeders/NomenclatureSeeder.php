<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NomenclatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nomenclature = [
            ['name' =>'Крем','producer_id'=> '1', 'price_type_id'=>'1'],
            ['name' =>'Вата','producer_id'=> '2', 'price_type_id'=>'1'],
            ['name' =>'Спирт','producer_id'=> '3', 'price_type_id'=>'1'],
            ['name' =>'Гематоген','producer_id'=> '3', 'price_type_id'=>'2'],
            ['name' =>'Визин','producer_id'=> '2', 'price_type_id'=>'2'],
            ['name' =>'Перчатки','producer_id'=> '1', 'price_type_id'=>'2'],
            ['name' =>'Смекта','producer_id'=> '2', 'price_type_id'=>'3'],
            ['name' =>'Нимесил','producer_id'=> '3', 'price_type_id'=>'3'],
            ['name' =>'Катетер','producer_id'=> '1', 'price_type_id'=>'3']
        ];
        \DB::table('nomenclatures')->insert($nomenclature);

    }
}
