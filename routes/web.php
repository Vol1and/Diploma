<?php /** @noinspection PhpUndefinedClassInspection */

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/report/selling-document/{id}/{mode}', [\App\Http\Controllers\FinanceDocumentController::class, 'sellingReports']);

Route::get('/report/income-document/{id}/{mode}', [\App\Http\Controllers\FinanceDocumentController::class, 'incomeReports']);
Route::get('/report/wares/{nomenclature_id}/{storage_id}', [\App\Http\Controllers\WareController::class, 'report']);
//Auth::routes();

//Route::middleware(['role:admin'])->prefix('/adm')->group(function () {
//    Route::get('/{any}', [App\Http\Controllers\Admin\HomeController::class, 'index'])->where('any', '.*');
//});

Route::get('/adm', function () {
    return redirect('/adm/home');
});

//Все дороги ведут в Рим
//Рим - главная страница которая лежит в шаблоне "home.blade.php"
//Дороги - любой раут в URL
//Из него Vue-Router рендерит соответствующий Vue-компонент
Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index'])->where('any', '^(?!/report).*+');

