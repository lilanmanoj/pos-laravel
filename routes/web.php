<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Makes login page as root page
Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::group([
    'middleware' => ['auth:sanctum', 'verified'],
    'namespace' => '\App\Http\Controllers'
], function () {
    Route::get('/sales/create', 'SalesController@create')->name('sales.create');
    Route::post('/sales/store', 'SalesController@store')->name('sales.store');

    Route::resource('products', 'ProductsController')->only([ 'index', 'create', 'store' ]);

    Route::post('sales/products/{barcode}', 'SalesController@getProductByBarcode')->name('sales.products.barcode');
});
