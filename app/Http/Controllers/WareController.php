<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class WareController extends OriginController
{
    //
    public function index(Request $request)
    {
        return $request->input('items');
    }
}
