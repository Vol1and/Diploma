<?php

namespace App\Http\Controllers;

use App\Repositories\StoragesRepository;
use DateInterval;
use DatePeriod;
use DateTime;
use DB;
use Illuminate\Http\Request;

class ChartController extends Controller
{


    private $storagesRepository;

    public function __construct()
    {
        $this->storagesRepository = app(StoragesRepository::class);
    }

    public function total_sales(Request $request)
    {

        $start = $request->input('start');
        $end = $request->input('end');

        if (empty($end)) $end = '2030-01-01';
        if (empty($start)) $start = '1970-01-01';

        $data = DB::select(
            "call diploma.find_all_cash('" . $start . "', '" . $end . "')");



        $below = '2030-01-01';
        $above = '1970-01-01';


        foreach ($data as $date) {
            if ($date->date < $below) $below = $date->date;
            if ($date->date > $above) $above = $date->date;
        }


        $dates = [];

        foreach (iterator_to_array(new DatePeriod(
            new DateTime($below),
            new DateInterval('P1D'),
            new DateTime(date('Y-m-d', strtotime($above . ' + 1 days'))
            ))) as $period) {
            $dates[] = $period->format("Y-m-d");
        }



        return ['data' => $data, 'period' =>$dates];
    }

    public function cash_by_users(Request $request)
    {

        $start = $request->input('start');
        $end = $request->input('end');

        if (empty($end)) $end = '2030-01-01';
        if (empty($start)) $start = '1970-01-01';


        return DB::select(
            "call diploma.find_all_cash_by_users('" . $start . "', '" . $end . "')");
    }

    public function total_sales_by_storage(Request $request)
    {

        $start = $request->input('start');
        $end = $request->input('end');
        $storages = $request->input('storages_id');


        if (empty($end)) $end = '2030-01-01';
        if (empty($start)) $start = '1970-01-01';
        if (empty($storages)) $storages = $this->storagesRepository->getStoragesId();


        foreach ($storages as $storage_id) {
            $data = DB::select(
            /** @lang MySQL */
                "call diploma.find_all_cash_by_storage('" . $start . "', '" . $end . "'," . $storage_id . ")");

            $storage_data[] = ['storage' => $this->storagesRepository->find($storage_id), 'data' => $data];


        }

        $below = '2030-01-01';
        $above = '1970-01-01';

        foreach ($storage_data as $res) {
            foreach ($res['data'] as $date) {
                if ($date->date < $below) $below = $date->date;
                if ($date->date > $above) $above = $date->date;
            }
        }

        $dates = [];

        foreach (iterator_to_array(new DatePeriod(
            new DateTime($below),
            new DateInterval('P1D'),
            new DateTime(date('Y-m-d', strtotime($above . ' + 1 days'))
            ))) as $period) {
            $dates[] = $period->format("Y-m-d");
        }

        return ['storage_data' => $storage_data, 'period' => $dates];
    }
}


