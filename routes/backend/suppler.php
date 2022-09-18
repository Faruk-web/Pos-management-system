<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\SupplierDashboardController;
use App\Http\Controllers\Backend\SupplerPaymentHistoryController;

    //======================================= Supplier All Route Group List Start ==================================//
    Route::prefix('suppliers')->middleware('routePermission')->group(function () {
        Route::get('/view', [SupplierController::class, 'show'])->name('suppliers.show');
        Route::post('/supplier/insertData', [SupplierController::class, 'store'])->name('suppliers.store');
        Route::get('/supplier/all', [SupplierController::class, 'SupplierDataShowAll']);
        Route::get('/supplier/delete/{id}', [SupplierController::class, 'SupplierDataDeleteAll'])->name('supplier_delete');
        Route::get('/supplier/edit/{id}', [SupplierController::class, 'SupplierEditAll']);
        Route::post('/supplier/updateData/{id}', [SupplierController::class, 'SupplierUpdateAll']);
        Route::get('/supplier/Active/all/{id}', [SupplierController::class, 'SupplierActive'])->name('SupplierActive');
        Route::get('/supplier/Deactive/all/{id}', [SupplierController::class, 'SupplierDeactive'])->name('SupplierDeactive');


        Route::get('/dashboard', [SupplierDashboardController::class, 'supplierDashboard'])->name('demo');
        Route::get('/supplierDashboard', [SupplierDashboardController::class, 'supplierDashboardForOwner'])->name('supplierDashboardForOwner');
        Route::get('/product_list', [SupplierDashboardController::class, 'supplierProduct'])->name('supplier.product');
        Route::get('/payment', [SupplierDashboardController::class, 'supplierPayment'])->name('supplier.payment');
        Route::get('/return_product', [SupplierDashboardController::class, 'supplierReturnProduct'])->name('supplier.return_product');
        Route::get('/all/supplier/{id}', [SupplerPaymentHistoryController::class, 'paymentHistory'])->name('allSuppilerList');
        Route::get('/single/product/show/{id}', [SupplerPaymentHistoryController::class, 'singleSupplierProductShow']);
        Route::post('/single/product/insert', [SupplerPaymentHistoryController::class, 'singleSupplierProductInsert']);
        Route::get('/supplierAllProductShow/{product_id}', [SupplierController::class, 'supplierAllProductShow'])->name('supplierAllProductShow');
        Route::post('/supplierAllProductShowSearch/{supplier_id?}', [SupplierController::class, 'supplierAllProductShowSearch'])->name('supplierAllProductShowSearch');
        Route::get('/acquisitionSupplierShow/{acquisition_supplier_id}', [SupplierController::class, 'acquisitionSupplierShow'])->name('acquisitionSupplierShow');
        // supplier confirm order list
        Route::get('/order/confirmation/list/', [SupplierController::class, 'orderConfirmationList'])->name('orderConfirmationList');
        // Supplier Order Items list
        Route::get('/order/items/confirmation/list/{order_id}', [SupplierController::class, 'orderItemsConfirmationList'])->name('orderItemsConfirmationList');
    });
    //======================================= Supplier All Route Group List End ==================================//