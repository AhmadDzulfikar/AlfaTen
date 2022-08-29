<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Customer\cartsController;

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
    return view('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\homeController::class, 'index'])
    ->name('home');

Route::controller(App\Http\Controllers\Customer\homeController::class)
    ->prefix("customer")
    ->group(function() {
        Route::get('/home', 'index')->name('customer.home');
        Route::post('/addToChart', 'addToCart')->name("customer.addToCart");
    });

    Route::prefix('customer')->group(function () {
        Route::get('/carts', [cartsController::class, 'index'])->name('customer.carts');
        Route::get('/carts/delete/{product}', [cartsController::class, 'destroy']);
    });

Route::get('cashier/home', function () {
})->name('cashier.home');
Route::get('manager/home', function () {
})->name('manager.home');   
