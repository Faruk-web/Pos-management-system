
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ShopOwnerController;


    //   Shop Owner Route List
    Route::prefix('shop_owner')->name('shop_owner.')->group(function () {
        Route::get('/view', [ShopOwnerController::class, 'view'])->name('view');
        Route::get('/getAll', [ShopOwnerController::class, 'getAll'])->name('getAll');
        Route::post('/store', [ShopOwnerController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ShopOwnerController::class, 'edit'])->name('edit');
        Route::post('/update', [ShopOwnerController::class, 'update'])->name('update');
        Route::post('/destroy/{id}', [ShopOwnerController::class, 'destroy'])->name('destroy');

        //new owner route
        Route::get('dashboard/view', [ShopOwnerController::class, 'dashboard'])->name('dashboard');
        Route::get('paymentHistory/view', [ShopOwnerController::class, 'paymentHistory'])->name('paymentHistory');
        Route::get('ownerProductList/view', [ShopOwnerController::class, 'ownerProductList'])->name('ownerProductList');
        Route::get('profitReport/view', [ShopOwnerController::class, 'profitReport'])->name('profitReport');
        Route::get('ownerReturnProduct/view', [ShopOwnerController::class, 'ownerReturnProduct'])->name('ownerReturnProduct');

        Route::get('ownerSupplierList/view', [ShopOwnerController::class, 'ownerSupplierList'])->name('ownerSupplierList');
        Route::post('/owner/insertData', [ShopOwnerController::class, 'ownerStore'])->name('ownerStore');
        // Route::get('/supplier/all', [ShopOwnerController::class, 'SupplierDataShowAll']);
        Route::get('/owner/delete/{id}', [ShopOwnerController::class, 'SupplierDataDeleteAll']);
        // Route::get('/supplier/edit/{id}', [ShopOwnerController::class, 'SupplierEditAll']);
        // Route::post('/supplier/updateData/{id}', [ShopOwnerController::class, 'SupplierUpdateAll']);

        //owner shop return product route
        Route::get('/ownerreturnproduct/show/{id}', [ShopOwnerController::class, 'returnProductGet']);
        Route::post('/ownerreturnproduct/insert', [ShopOwnerController::class, 'returnProductCeate']);
    });
    // End Shop Owner Route List