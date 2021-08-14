<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

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



Route::get('/product',[ProductController::class,'list'])->name('product-list');
Route::get('/product/create',[ProductController::class,'createForm'])->name('product-create-form');
Route::post('/product/create',[ProductController::class,'create'])->name('product-create');

Route::get('/product{code}/update',[ProductController::class,'updateForm'])->name('product-update-form');
Route::post('/product{code}/update',[ProductController::class,'update'])->name('product-update');

Route::get('/product{code}/delete',[ProductController::class,'delete'])->name('product-delete');

Route::get('/product/{code}',[ProductController::class,'detail'])->name('product-detail');



Route::get('/shop',[ShopController::class,'list'])->name('shop-list');
Route::get('/shop/create',[ShopController::class,'createForm'])->name('shop-create-form');
Route::post('/shop/create',[ShopController::class,'create'])->name('shop-create');

Route::get('/shop{code}/update',[ShopController::class,'updateForm'])->name('shop-update-form');
Route::post('/shop{code}/update',[ShopController::class,'update'])->name('shop-update');

Route::get('/shop{code}/delete',[ShopController::class,'delete'])->name('shop-delete');

Route::get('/shop/{code}',[ShopController::class,'detail'])->name('shop-detail');



