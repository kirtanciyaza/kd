<?php

use App\Http\Controllers\api\EventController;
use App\Http\Controllers\api\PassportAuthController;
use App\Http\Controllers\ProductImageController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {

Route::get('product',[ProductImageController::class, 'index']);
Route::post('product/store',[ProductImageController::class, 'store']);
Route::get('product/show/{id}',[ProductImageController::class, 'show']);
Route::get('product/edit/{id}',[ProductImageController::class, 'edit']);
Route::put('product/update/{id}',[ProductImageController::class, 'update']);
Route::delete('product/delete/{id}',[ProductImageController::class, 'delete']);


Route::get('event/index',[EventController::class, 'index']);
Route::post('event/store',[EventController::class, 'store']);
Route::get('event/{id}',[EventController::class, 'edit']);
Route::post('event/update/{id}',[EventController::class, 'update']);
Route::delete('event/destroy/{id}',[EventController::class, 'destroy']);

});



Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);
