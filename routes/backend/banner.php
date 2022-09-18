<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\AdminProfileController;
    // Admin Banner  Route Group
    Route::prefix('banner')->middleware('routePermission')->group(function () {
        Route::get('/view', [BannerController::class, 'BennarView'])->name('bennar.manage');
        Route::post('/store', [BannerController::class, 'BennarStore'])->name('bennar.store');
        Route::get('/edit/{id}', [BannerController::class, 'BennarEdit'])->name('bennar.edit');
        Route::post('/update', [BannerController::class, 'BennarUpdate'])->name('bennar.update');
        Route::get('/dalete/{id}', [BannerController::class, 'BennarDelete'])->name('bennar.delete');
        // for Deactive
        Route::get('/deactive/{id}', [BannerController::class, 'BennarDeactive'])->name('bennar.deactive');
        // for Active
        Route::get('/active/{id}', [BannerController::class, 'BennarActive'])->name('bennar.active');
        // for sub category and shop now banner
        Route::get('/show', [BannerController::class, 'BannerAllView'])->name('banner.view.manage');
        //  sub category banner
        Route::post('subcategorybanner/store', [BannerController::class, 'SubCatBannerStore'])->name('subcategorybanner.store');
        Route::get('/subcategorybanner/edit/{id}', [BannerController::class, 'SubCatBannerEdit'])->name('subcategorybanner.edit');
        Route::post('/subcategorybanner/update/{id}', [BannerController::class, 'SubCatBannerUpdate'])->name('subcategorybanner.update');
        Route::get('/subcategorybanner/dalete/{id}', [BannerController::class, 'SubCatBannerDelete'])->name('subcategorybanner.delete');
        // shop now  banner store
        Route::post('shopnowbanner/store', [BannerController::class, 'ShopNowStore'])->name('shopnowbanner.store');
        Route::get('/shopnowbanner/edit/{id}', [BannerController::class, 'ShopNowEdit'])->name('shopnowbanner.edit');
        Route::post('/shopnowbanner/update', [BannerController::class, 'ShopNowUpdate'])->name('shopnowbanner.update');
        Route::post('/shopnowbanner/update/{id}', [BannerController::class, 'ShopNowUpdate'])->name('ShopNowbanner.update');
        Route::get('/shopnowbanner/dalete/{id}', [BannerController::class, 'ShopNowDelete'])->name('ShopNowbanner.delete');
        //
    });