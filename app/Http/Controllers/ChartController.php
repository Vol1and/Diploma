<?php

namespace App\Http\Controllers;

use DB;

class ChartController extends Controller
{


    public function totalSales(){

        return DB::select(
            "call diploma.find_all_cash('1970-01-01', '2030-01-01')"
        );

    }
}
