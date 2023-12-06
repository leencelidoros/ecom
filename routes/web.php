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

 Route::get('/home', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
 Route::get('/detail/{id}', [App\Http\Controllers\ProductController::class, 'detail']);  
 Route::post('/search', [App\Http\Controllers\ProductController::class,'search']);
 Route::get( '/search', [App\Http\Controllers\ProductController::class, 'search'])->name('search');
 Route::post('/add_to_cart', [App\Http\Controllers\ProductController::class, 'addToCart']);  

