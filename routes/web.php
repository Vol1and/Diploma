<?php

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


//Auth::routes();


//Все дороги ведут в Рим
//Рим - главная страница которая лежит в шаблоне "home.blade.php"
//Дороги - любой раут в URL
//Из него Vue-Router рендерит соответствующий Vue-компонент
Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index'])->where('any', '.*');
