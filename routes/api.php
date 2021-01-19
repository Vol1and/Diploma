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
Route::apiResource('/characteristics', "App\Http\Controllers\CharacteristicController");
Route::apiResource('/agents', "App\Http\Controllers\AgentController");
Route::apiResource('/nomenclatures', "App\Http\Controllers\NomenclatureController");
Route::apiResource('/storages', "App\Http\Controllers\StorageController");
Route::apiResource('/income-documents', "App\Http\Controllers\DocumentController");



Route::get('/producer/filter', [App\Http\Controllers\ProducerController::class, 'filter']);
Route::get('/nomenclature/filter', [App\Http\Controllers\NomenclatureController::class, 'filter']);

Route::post('/income' , [\App\Http\Controllers\DocumentController::class, 'incomeCreate']);

Route::post('/test' , [\App\Http\Controllers\WareController::class, 'index']);


Route::get('/characteristic/for-nomenclature/{id}', [App\Http\Controllers\CharacteristicController::class, 'forNomenclature']);

