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

//прописание API-маршрутов для контроллеров
Route::apiResource('/producers', "App\Http\Controllers\ProducerController");
Route::apiResource('/price-types', "App\Http\Controllers\PriceTypeController");
Route::apiResource('/nomenclatures', "App\Http\Controllers\NomenclatureController");

Route::apiResource('/characteristics', "App\Http\Controllers\CharacteristicController");

Route::get('/characteristic/for-nomenclature/{id}', [App\Http\Controllers\CharacteristicController::class, 'forNomenclature']);

