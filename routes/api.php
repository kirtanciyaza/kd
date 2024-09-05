<?php

use App\Http\Controllers\ProductImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('product',[ProductImageController::class, 'index']);
Route::post('product/store',[ProductImageController::class, 'store']);
Route::get('product/show/{id}',[ProductImageController::class, 'show']);
Route::get('product/edit/{id}',[ProductImageController::class, 'edit']);
Route::put('product/update/{id}',[ProductImageController::class, 'update']);
Route::delete('product/delete/{id}',[ProductImageController::class, 'delete']);
