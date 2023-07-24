<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
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
    return view('welcome');
});

Auth::routes();

//Route::get('/products', [ProductController::class, 'index'])->name('home');
Route::resource('products', ProductController::class);
Route::delete('images/{id}', [ImageController::class, 'destroy']);

Route::post('products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
