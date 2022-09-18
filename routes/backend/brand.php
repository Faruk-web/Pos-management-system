

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ListBrandController;

Route::prefix('brandnew')->name('brandnew.')->group(function () {
    Route::get('/add', [BrandController::class, 'BrandnewAdd'])->name('allbrand');
    Route::post('/store', [BrandController::class, 'BrandnewStore'])->name('store');
    Route::get('/view', [BrandController::class, 'BrandnewView'])->name('view');
    Route::get('/edit/{id}', [BrandController::class, 'BrandnewEdit'])->name('edit');
    Route::post('/update/{id}', [BrandController::class, 'BrandnewUpdate'])->name('update');
    Route::get('/delete/{id}', [BrandController::class, 'BrandnewDelete'])->name('delete');
});

 //..... old Brand crud.....//
    Route::prefix('brand')->group(function () {

        Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');
        Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
        Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
        Route::post('/update/{id}', [BrandController::class, 'BrandUpdate'])->name('brand.update');
        Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
        Route::get('/brand/destroy/{brand_id}', [BrandController::class, 'destroy']);
    });

     //  Ecommerce Name,Brand,Cat,SubCat,SubSubCat  Route Group
     Route::prefix('listbrandCategory')->middleware('routePermission')->group(function () {
        Route::get('/view', [ListBrandController::class, 'ListView'])->name('listbrandCategory.manage');
        Route::post('/ecommercename/store', [ListBrandController::class, 'EcommerceStore'])->name('ecommerce.store');
        Route::get('/ecommercename/edit/{id}', [ListBrandController::class, 'EcommerceEdit'])->name('ecommerce.edit');
        Route::post('/ecommercename/update/{id}', [ListBrandController::class, 'EcommerceUpdate'])->name('ecommerce.update');
        Route::get('/dalete/{id}', [ListBrandController::class, 'EcommerceDelete'])->name('ecommerce.delete');
        //  for autoload
        Route::get('/autoload/all/{id}', [ListBrandController::class, 'AutoloadAll'])->name('autoload.all');
    });
  