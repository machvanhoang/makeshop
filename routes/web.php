<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AsyncController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\ImportController;
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
        'prefix' => 'settings',
        'as' => 'settings.'
    ],
    function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::put('/update', [SettingsController::class, 'update'])->name('update');
        Route::put('/parse_access_token', [SettingsController::class, 'parse_access_token'])->name('parse_access_token');
    }
);
Route::group(
    [
        'middleware' => ['auth'],
        'prefix' => 'async',
        'as' => 'async.'
    ],
    function () {
        Route::get('/', [AsyncController::class, 'index'])->name('index');
        Route::put('/total_product', [AsyncController::class, 'total_product'])->name('total_product');
        Route::post('/checking', [AsyncController::class, 'checking'])->name('checking');
        Route::post('/async', [AsyncController::class, 'async'])->name('async');
        Route::post('/async_single', [AsyncController::class, 'async_single'])->name('async_single');
    }
);

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
        'prefix' => 'command',
        'as' => 'command.'
    ],
    function () {
        Route::match(['get', 'post'], '/', [CommandController::class, 'index'])->name('index');
    }
);
