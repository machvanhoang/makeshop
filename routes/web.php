<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Import\ImportProductController;
use App\Http\Controllers\Import\ImportCategoriesController;
use App\Http\Controllers\Import\ImportProductCategoriesController;
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
        'prefix' => 'product',
        'as' => 'product.'
    ],
    function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
    }
);

Route::group(
    [
        'middleware' => ['auth'],
        'prefix' => 'category',
        'as' => 'category.'
    ],
    function () {
        Route::get('/', [CategoriesController::class, 'index'])->name('index');
    }
);

Route::group(
    [
        'middleware' => ['auth'],
        'prefix' => 'import',
        'as' => 'import.'
    ],
    function () {
        Route::get('/product', [ImportProductController::class, 'index'])->name('product');
        Route::post('/product', [ImportProductController::class, 'import'])->name('product.post');
        Route::match(['get', 'post'], '/category', [ImportCategoriesController::class, 'index'])->name('category');
        Route::match(['get', 'post'], '/product-category', [ImportProductCategoriesController::class, 'index'])->name('product-category');
        Route::post('/import-product-category', [ImportProductCategoriesController::class, 'import'])->name('product-category.post');
    }
);
