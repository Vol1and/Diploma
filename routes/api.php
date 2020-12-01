<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//API-ветка по контроллеру ProducerController
Route::prefix('producers')->group(function () {
    //Все AJAX-запросы, помещенные в эту группу, будут иметь префикс /producers/...
    Route::get('getTable',  [App\Http\Controllers\ProducerController::class, 'getTable']);

});
