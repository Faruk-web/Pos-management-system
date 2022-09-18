<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\PosCartController;

 //  Pos Route Group
 Route::prefix('pos')->middleware('routePermission')->group(function () {
    Route::get('/pos', [PosController::class, 'pos'])->name('pos');
    Route::get('/search/{id}', [PosController::class, 'search']);
    Route::get('/product/list/{categorie_id}', [PosController::class, 'PosProductList'])->name('product.list');
    Route::get('/brand/product/list/{brand_id}', [PosController::class, 'PosBrandProductList'])->name('brand.product.list');
    Route::post('/carts/add/{product_id}', [PosCartController::class, 'addProductToCart'])->name('pos.product.add');
});
