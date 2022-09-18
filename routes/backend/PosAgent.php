<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PosAgentController;
use App\Http\Controllers\Backend\PosCartAgentController;
  // Agent Pos All Route
  Route::prefix('pos_agent')->group(function () {
    Route::get('/pos', [PosAgentController::class, 'Pos'])->name('pos_agent');
    Route::get('/search/{id}', [PosAgentController::class, 'search']);
    Route::get('/product/list/{categorie_id}', [PosAgentController::class, 'PosProductList'])->name('agent_product.list');
    Route::get('/brand/product/list/{brand_id}', [PosAgentController::class, 'PosBrandProductList'])->name('agent_brand.product.list');
    Route::post('/carts/add/{product_id}', [PosCartAgentController::class, 'addProductToCart'])->name('pos_agent.product.add');
});
