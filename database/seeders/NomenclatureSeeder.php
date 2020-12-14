<?php

namespace Database\Seeders;

use DB;
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
            ['name' =>'Спирт 95%'   , 'med_form_id'=> 3, 'producer_id'=> 1, 'price_type_id'=> 1],
            ['name' =>'Вата'        , 'med_form_id'=> 4, 'producer_id'=> 2, 'price_type_id'=> 1],
            ['name' =>'Альмагель'   , 'med_form_id'=> 6, 'producer_id'=> 3, 'price_type_id'=> 1],
            ['name' =>'Лориста Н'   , 'med_form_id'=> 1, 'producer_id'=> 3, 'price_type_id'=> 2],
            ['name' =>'Визин'       , 'med_form_id'=> 3, 'producer_id'=> 2, 'price_type_id'=> 2],
            ['name' =>'Перчатки'    , 'med_form_id'=> 6, 'producer_id'=> 1, 'price_type_id'=> 2],
            ['name' =>'Смекта'      , 'med_form_id'=> 4, 'producer_id'=> 2, 'price_type_id'=> 3],
            ['name' =>'Нимесил'     , 'med_form_id'=> 2, 'producer_id'=> 3, 'price_type_id'=> 3],
            ['name' =>'Катетер'     , 'med_form_id'=> 6, 'producer_id'=> 1, 'price_type_id'=> 3]
        ];
        DB::table('nomenclatures')->insert($nomenclature);

    }
}
