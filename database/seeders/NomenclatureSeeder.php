<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

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
            ['name' =>'Спирт 95%'   , 'med_form_id'=> 3, 'producer_id'=> 1, 'price_type_id'=> 1, 'created_at' => Carbon::now(), 'updated_at' =>Carbon::now() ],
            ['name' =>'Вата'        , 'med_form_id'=> 4, 'producer_id'=> 2, 'price_type_id'=> 1, 'created_at' => Carbon::now(), 'updated_at' =>Carbon::now() ],
            ['name' =>'Альмагель'   , 'med_form_id'=> 6, 'producer_id'=> 3, 'price_type_id'=> 1, 'created_at' => Carbon::now(), 'updated_at' =>Carbon::now() ],
            ['name' =>'Лориста Н'   , 'med_form_id'=> 1, 'producer_id'=> 3, 'price_type_id'=> 2, 'created_at' => Carbon::now(), 'updated_at' =>Carbon::now() ],
            ['name' =>'Визин'       , 'med_form_id'=> 3, 'producer_id'=> 2, 'price_type_id'=> 2, 'created_at' => Carbon::now(), 'updated_at' =>Carbon::now() ],
            ['name' =>'Перчатки'    , 'med_form_id'=> 6, 'producer_id'=> 1, 'price_type_id'=> 2, 'created_at' => Carbon::now(), 'updated_at' =>Carbon::now() ],
            ['name' =>'Смекта'      , 'med_form_id'=> 4, 'producer_id'=> 2, 'price_type_id'=> 3, 'created_at' => Carbon::now(), 'updated_at' =>Carbon::now() ],
            ['name' =>'Нимесил'     , 'med_form_id'=> 2, 'producer_id'=> 3, 'price_type_id'=> 3, 'created_at' => Carbon::now(), 'updated_at' =>Carbon::now() ],
            ['name' =>'Катетер'     , 'med_form_id'=> 6, 'producer_id'=> 1, 'price_type_id'=> 3, 'created_at' => Carbon::now(), 'updated_at' =>Carbon::now() ]
        ];
        DB::table('nomenclatures')->insert($nomenclature);

    }
}
