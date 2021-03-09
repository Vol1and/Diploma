<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ChartController extends Controller
{


    public function total_sales(Request $request)
    {

        $start = $request->input('start');
        $end = $request->input('end');

        if (empty($end) || empty($start)) return DB::select(
            "call diploma.find_all_cash('1970-01-01', '2030-01-01')"
        );

        return DB::select(
            "call diploma.find_all_cash('" . $start . "', '" . $end . "')");
    }

    public function cash_by_users(Request $request)
    {

        $start = $request->input('start');
        $end = $request->input('end');

        if (empty($end) || empty($start)) return DB::select(
            "call diploma.find_all_cash_by_users('1970-01-01', '2030-01-01')"
        );

        return DB::select(
            "call diploma.find_all_cash_by_users('" . $start . "', '" . $end . "')");

    }
}
