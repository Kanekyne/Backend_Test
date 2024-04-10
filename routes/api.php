<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//                                            PRODUCTS
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

Route::GET('/products/list', [ProductController::class, 'index'])->name('product.list');
Route::POST('/products/store', [ProductController::class, 'store'])->name('product.store');
Route::PATCH('/products/update/{product}', [ProductController::class, 'update'])->name('product.update');
Route::DELETE('/products/delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::GET('/products/quantity/{category}', [ProductController::class, 'quantity'])->name('product.quantity');


// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//                                            CATEGORY
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


Route::GET('/categories/list', [CategoryController::class, 'index'])->name('categories.list');
Route::POST('categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::PATCH('categories/update/{category}', [CategoryController::class, 'update'])->name('categories.update');
// Route::PUT('categories/update/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::DELETE('categories/delete/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
