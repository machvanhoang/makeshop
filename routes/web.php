<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ImportProductController;
use App\Http\Controllers\SearchController;
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

Route::get('/', function () {
    return view('index');
});

Auth::routes([
    'register' => false,
    'password.reset' => false,
    'reset' => false
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/search.html', [SearchController::class, 'search'])->name('search');
Route::group(
    [
        'middleware' => ['auth'],
        'prefix' => 'import',
        'as' => 'import.'
    ],
    function () {
        Route::match(['get', 'post'], '/', [ImportController::class, 'index'])->name('index');
    }
);

Route::group(
    [
        'middleware' => ['auth'],
        'prefix' => 'import_product',
        'as' => 'import_product.'
    ],
    function () {
        Route::match(['get', 'post'], '/', [ImportProductController::class, 'index'])->name('index');
    }
);

Route::group(
    [
        'middleware' => ['auth'],
        'prefix' => 'command',
        'as' => 'command.'
    ],
    function () {
        Route::match(['get', 'post'], '/', [CommandController::class, 'index'])->name('index');
    }
);