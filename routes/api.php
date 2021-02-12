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
Route::apiResource('/finance-documents', "App\Http\Controllers\FinanceDocumentController");
Route::apiResource('/wares', "App\Http\Controllers\WareController");


Route::get('/producer/filter', [App\Http\Controllers\ProducerController::class, 'filter']);
Route::get('/nomenclature/filter', [App\Http\Controllers\NomenclatureController::class, 'filter']);
Route::get('/income-document/filter', [App\Http\Controllers\FinanceDocumentController::class, 'incomeFilter']);

Route::post('/income' , [\App\Http\Controllers\FinanceDocumentController::class, 'incomeCreate']);
Route::post('/income/{id}' , [\App\Http\Controllers\FinanceDocumentController::class, 'incomeUpdate']);
Route::post('/characteristics/{nomenclature_id}/create' , [\App\Http\Controllers\CharacteristicController::class, 'store']);


Route::get('/characteristic/for-nomenclature/{id}', [App\Http\Controllers\CharacteristicController::class, 'getAllByNomenclatureId']);


Route::get('/characteristic/by-nomenclature-storage/{nomenclature_id}/{storage_id}', [App\Http\Controllers\CharacteristicController::class, 'getAllByNomenclatureAndStorageIdWithWares']);

Route::get('/sellings' , [App\Http\Controllers\FinanceDocumentController::class, 'getSellings']);
