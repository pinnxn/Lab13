<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
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

Route::get('/product/{code}/shop',[ProductController::class,'showShop'])->name('product-shop');


Route::get('/product/{product}/shop/add',[ProductController::class,'addShopForm'])->name('product-add-shop-form'); 
Route::post('/product/{product}/shop/add',[ProductController::class,'addShop'])->name('product-add-shop');

Route::get('/product/{product}/shop/{shop}/remove',  [ProductController::class, 'removeShop'])->name('product-remove-shop');


Route::get('/shop',[ShopController::class,'list'])->name('shop-list');
Route::get('/shop/create',[ShopController::class,'createForm'])->name('shop-create-form');
Route::post('/shop/create',[ShopController::class,'create'])->name('shop-create');

Route::get('/shop{code}/update',[ShopController::class,'updateForm'])->name('shop-update-form');
Route::post('/shop{code}/update',[ShopController::class,'update'])->name('shop-update');

Route::get('/shop{code}/delete',[ShopController::class,'delete'])->name('shop-delete');

Route::get('/shop/{code}',[ShopController::class,'detail'])->name('shop-detail');

Route::get('/shop/{code}/product',[ShopController::class,'showProduct'])->name('shop-product');

Route::get('/shop/{code}/product/add',[ShopController::class,'addProductForm'])->name('shop-add-product-form');
Route::post('/shop/{code}/product/add',[ShopController::class,'addProduct'])->name('shop-add-product');

Route::get('/shop/{shop}/product/{product}/remove',  [ShopController::class, 'removeProduct'])->name('shop-remove-product');

Route::get('/category',[CategoryController::class,'list'])->name('category-list');
Route::get('/category/create',[CategoryController::class,'createForm'])->name('category-create-form');
Route::post('/category/create',[CategoryController::class,'create'])->name('category-create');

Route::get('/category{code}/update',[CategoryController::class,'updateForm'])->name('category-update-form');
Route::post('/category{code}/update',[CategoryController::class,'update'])->name('category-update');

Route::get('/category{code}/delete',[CategoryController::class,'delete'])->name('category-delete');

Route::get('/category/{code}',[CategoryController::class,'detail'])->name('category-detail');

Route::get('/category/{code}/product',[CategoryController::class,'showProduct'])->name('category-product');

Route::get('/category/{code}/product/add',[CategoryController::class,'addProductForm'])->name('category-add-product-form');
Route::post('/category/{code}/product/add',[CategoryController::class,'addProduct'])->name('category-add-product');
