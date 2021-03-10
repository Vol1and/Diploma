<?php

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

Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {

    Route::post('login', [\App\Http\Controllers\Api\LoginController::class, 'login'])->name('login');

    Route::post('register', [\App\Http\Controllers\Api\RegisterController::class, 'register'])->name('register');
    Route::post('logout', [\App\Http\Controllers\Api\LoginController::class, 'logout'])->name('logout');
    Route::get('user', [\App\Http\Controllers\Api\AuthenticationController::class, 'user'])->name('user');

});

//прописание API-маршрутов для контроллеров
Route::apiResource('/producers', "App\Http\Controllers\ProducerController");
Route::apiResource('/price-types', "App\Http\Controllers\PriceTypeController");
Route::apiResource('/characteristics', "App\Http\Controllers\CharacteristicController");
Route::apiResource('/agents', "App\Http\Controllers\AgentController");
Route::apiResource('/nomenclatures', "App\Http\Controllers\NomenclatureController");
Route::apiResource('/storages', "App\Http\Controllers\StorageController");
Route::apiResource('/finance-documents', "App\Http\Controllers\FinanceDocumentController");
Route::apiResource('/storage-documents', "App\Http\Controllers\StorageDocumentController");
Route::apiResource('/wares', "App\Http\Controllers\WareController");
Route::apiResource('/workplaces', "App\Http\Controllers\WorkPlaceController");

//фильтры документов
Route::get('/producer/filter', [App\Http\Controllers\ProducerController::class, 'filter']);
Route::get('/nomenclature/filter', [App\Http\Controllers\NomenclatureController::class, 'filter']);
Route::get('/income-document/filter', [App\Http\Controllers\FinanceDocumentController::class, 'incomeFilter']);

//отдельные роуты для документов
Route::get('/sellings', [App\Http\Controllers\FinanceDocumentController::class, 'getSellings']);
Route::get('/selling', [App\Http\Controllers\FinanceDocumentController::class, 'incomeCreate']);

Route::get('/transfers', [App\Http\Controllers\StorageDocumentController::class, 'indexOfTransfers']);
Route::post('/transfer', [App\Http\Controllers\StorageDocumentController::class, 'transferCreate']);
Route::post('/transfer/{id}', [App\Http\Controllers\StorageDocumentController::class, 'transferUpdate']);

Route::post('/income', [App\Http\Controllers\FinanceDocumentController::class, 'incomeCreate']);
Route::post('/income/{id}', [App\Http\Controllers\FinanceDocumentController::class, 'incomeUpdate']);

Route::post('/cancellation', [App\Http\Controllers\StorageDocumentController::class, 'cancellationCreate']);
Route::post('/cancellation/{id}', [App\Http\Controllers\StorageDocumentController::class, 'cancellationUpdate']);


Route::post('/characteristics/{nomenclature_id}/create', [App\Http\Controllers\CharacteristicController::class, 'store']);
Route::get('/characteristic/for-nomenclature/{id}', [App\Http\Controllers\CharacteristicController::class, 'getAllByNomenclatureId']);
Route::get('/characteristic/by-nomenclature-storage/{nomenclature_id}/{storage_id}', [App\Http\Controllers\CharacteristicController::class, 'getAllByNomenclatureAndStorageIdWithWares']);


Route::post('/cashier/send', [App\Http\Controllers\FinanceDocumentController::class, "sell"]);

Route::get('/charts/total-sales', [App\Http\Controllers\ChartController::class, "total_sales"]);
Route::get('/charts/users-sales', [App\Http\Controllers\ChartController::class, "cash_by_users"]);
