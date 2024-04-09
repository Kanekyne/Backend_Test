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

Route::GET('/products/list', [ProductController::class, 'index'])->name('productor.list');
Route::POST('/products', [ProductController::class, 'store'])->name('productor.store');
Route::GET('/products/{product}/edit', [ProductController::class, 'edit'])->name('productor.update');
Route::PATCH('/products/{product}', [ProductController::class, 'update'])->name('productor.destroy');


// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//                                            CATEGORY
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


Route::GET('/categories/list', [CategoryController::class, 'index'])->name('categories.list');
Route::POST('categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::PUT('categories/update/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::DELETE('categories/delete/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
