<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//                                            PRODUCTS
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

Route::GET('/products/{status}', [ProductController::class, 'getProducts'])->name('productor.products');
Route::GET('/products/create/new', [ProductController::class, 'create'])->name('productor.products.create');
Route::POST('/products', [ProductController::class, 'store'])->name('productor.products.store');
Route::GET('/products/{product}/edit', [ProductController::class, 'edit'])->name('productor.products.edit');
Route::PATCH('/products/{product}', [ProductController::class, 'update'])->name('productor.products.update');


    // XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    //                                            CATEGORY
    // XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


    Route::get('/categories', [CategoryController::class, 'index'])->name('productor.categories');
    Route::get('/add', [CategoryController::class, 'addCategories'])->name('productor.categories.add');
