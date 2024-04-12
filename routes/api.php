<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DialogflowController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//                                            PRODUCTS
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


// Route::GET('/products/list', [ProductController::class, 'index'])->name('product.list');
// Route::POST('/products/store', [ProductController::class, 'store'])->name('product.store');
// Route::PATCH('/products/update/{product}', [ProductController::class, 'update'])->name('product.update');
// Route::DELETE('/products/delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
// Route::POST('/products/quantity/{category}', [ProductController::class, 'quantity'])->name('product.quantity');
// Route::GET('/products/quantity/{categoryName}', [ProductController::class, 'quantity_name'])->name('product.quantity');

Route::resource('products', ProductController::class)->only([
    'index',
    'store',
    'update',
    'destroy'
]);

Route::post('/products/quantity/{category}', [ProductController::class, 'quantity'])->name('product.quantity');
Route::get('/products/quantity/{categoryName}', [ProductController::class, 'quantity_name'])->name('product.quantity');


// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//                                            CATEGORY
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

Route::resource('categories', CategoryController::class)->only([
    'index', 'store', 'update', 'destroy'
]);

// Route::GET('/categories/list', [CategoryController::class, 'index'])->name('category.list');
// Route::POST('categories/store', [CategoryController::class, 'store'])->name('category.store');
// Route::PATCH('categories/update/{category}', [CategoryController::class, 'update'])->name('category.update');
// Route::DELETE('categories/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');


// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//                                            DIALOGFLOW
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

// Route::POST('/dialogflow', [DialogflowController::class, 'process']); //COPILOT
Route::POST('/dialogflow', [DialogflowController::class, 'quantity']); //COPILOT

