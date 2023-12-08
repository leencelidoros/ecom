<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
    Route::get('/detail/{id}', [App\Http\Controllers\ProductController::class, 'detail']);  
    Route::post('/search', [App\Http\Controllers\ProductController::class, 'search'])->name('search');
    Route::post('/add_to_cart', [App\Http\Controllers\ProductController::class, 'addToCart']);  
    Route::get('/cartlist', [App\Http\Controllers\ProductController::class, 'cartlist'])->name('cartlist');
    Route::get('/remove-cart/{id}', [App\Http\Controllers\ProductController::class, 'removecart']);
    Route::get('/order', [App\Http\Controllers\ProductController::class, 'order']);
    Route::POST('/orderplace', [App\Http\Controllers\ProductController::class, 'orderPlace']);



});

