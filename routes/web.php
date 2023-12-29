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
    return view('welcome');
});

Auth::routes();

Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
Route::get('create-product', [App\Http\Controllers\ProductController::class, 'createProduct'])->name('createProduct');
Route::post('store-product', [App\Http\Controllers\ProductController::class, 'storeProduct'])->name('storeProduct');

Route::get('edit-product/{id}', [App\Http\Controllers\ProductController::class, 'editProduct'])->name('editProduct');
Route::get('edit-product2/{id}', [App\Http\Controllers\ProductController::class, 'editProductajax'])->name('editProduct2');

Route::post('update-product/{id}', [App\Http\Controllers\ProductController::class, 'updateProduct'])->name('updateProduct');
Route::delete('delete-product/{id}', [App\Http\Controllers\ProductController::class, 'deleteProduct'])->name('deleteProduct');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
