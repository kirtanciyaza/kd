<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QQQController;
use Illuminate\Support\Facades\Route;

Route::get('/kd',[EventController::class, 'frontevent'])->name('event.frontevent');

Route::get('product/index',[ProductController::class, 'index'])->name('product.index');
Route::get('product/create',[ProductController::class, 'create'])->name('product.create');
Route::post('product/store',[ProductController::class, 'store'])->name('product.store');
Route::get('product/show/{id}',[ProductController::class, 'show'])->name('product.show');
Route::get('product/edit/{id}',[ProductController::class, 'edit'])->name('product.edit');
Route::put('product/update/{id}',[ProductController::class, 'update'])->name('product.update');
Route::delete('product/delete/{id}',[ProductController::class, 'delete'])->name('product.delete');
Route::get('qrcode/{id}',[ProductController::class, 'qrcode'])->name('product.qrcode');
Route::get('/test',[ProductController::class, 'llss'])->name('llss');

Route::get('event/index',[EventController::class, 'index'])->name('event.index');
Route::get('event/create',[EventController::class, 'create'])->name('event.create');
Route::post('event/store',[EventController::class, 'store'])->name('event.store');
Route::get('event/{id}',[EventController::class, 'edit'])->name('event.edit');
Route::put('event/{id}/update',[EventController::class, 'update'])->name('event.update');
Route::delete('event/{id}/destroy',[EventController::class, 'destroy'])->name('event.destroy');

Route::get('/index',[QQQController::class, 'index'])->name('qqq');
Route::get('/create',[QQQController::class, 'create'])->name('qqq.create');
Route::get('/edit/{id}',[QQQController::class, 'editView'])->name('qqq.edit');

Route::get('/login',[QQQController::class, 'login'])->name('qqq.login');
Route::get('/',[QQQController::class, 'register'])->name('qqq.register');
