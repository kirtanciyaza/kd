<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('product/index',[ProductController::class, 'index'])->name('product.index');
Route::get('product/create',[ProductController::class, 'create'])->name('product.create');
Route::post('product/store',[ProductController::class, 'store'])->name('product.store');
Route::get('product/show/{id}',[ProductController::class, 'show'])->name('product.show');
Route::get('product/edit/{id}',[ProductController::class, 'edit'])->name('product.edit');
Route::put('product/update/{id}',[ProductController::class, 'update'])->name('product.update');
Route::delete('product/delete/{id}',[ProductController::class, 'delete'])->name('product.delete');
Route::get('qrcode/{id}',[ProductController::class, 'qrcode'])->name('product.qrcode');
Route::get('/test',[ProductController::class, 'llss'])->name('llss');
