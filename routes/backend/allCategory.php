<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\BrandCategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\BannerCatagoryController;


Route::prefix('category')->name('category.')->group(function () {
    Route::get('/view', [CategoryController::class, 'CategoryView'])->name('catview');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::get('/fetchall', [CategoryController::class, 'fetchAll'])->name('fetchAll');
    Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
    // new
    Route::get('/cat/product/update/Active/all/{id}', [CategoryController::class, 'CatActive'])->name('CatActive');
    Route::get('/cat/product/update//Deactive/all/{id}', [CategoryController::class, 'CatDeactive'])->name('CatDeactive');
});
// for brand search
Route::get('admin/brand/search/ajax/{adminId}/{value}', [BrandController::class, 'searchBrandByAjax']);
// for category search
Route::get('admin/category/search/ajax/{adminId}/{value}', [CategoryController::class, 'searchCategoryByAjax']);
// for sub category search
Route::get('admin/subcategory/search/ajax/{adminId}/{value}', [SubCategoryController::class, 'searchSubcategoryByAjax']);
//for sub sub category search
Route::get('admin/subsubcategory/search/ajax/{adminId}/{value}', [SubSubCategoryController::class, 'searchSubsubcategoryByAjax']);



Route::prefix('subcategory')->name('subcategory.')->group(function () {
    Route::get('/view', [SubCategoryController::class, 'SubCategoryView'])->name('allsubcategory');
    Route::post('/store', [SubCategoryController::class, 'store'])->name('store');
    Route::get('/fetchall', [SubCategoryController::class, 'fetchAll'])->name('fetchAll');
    Route::get('/delete/{id}', [SubCategoryController::class, 'delete'])->name('delete');
    Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [SubCategoryController::class, 'update'])->name('update');

    Route::post('/active-deactive-subcategory/{id}', [SubCategoryController::class, 'activeDeactiveSubCategory'])->name('subCategoryActiveDeactive');
});



  //.................... Brand New crud with Jquery ....................//
  Route::prefix('brandcategory')->name('brandcategory.')->group(function () {
    Route::get('/add', [BrandCategoryController::class, 'AddBrandCategory'])->name('brandcategoryadd');
    Route::post('/store', [BrandCategoryController::class, 'AddBrandCategoryStore'])->name('store');
    Route::get('/view', [BrandCategoryController::class, 'AddBrandCategoryView'])->name('view');
    Route::get('/edit/{id}', [BrandCategoryController::class, 'AddBrandCategoryEdit'])->name('edit');
    Route::post('/update/{id}', [BrandCategoryController::class, 'AddBrandCategoryUpdate'])->name('update');
    Route::get('/delete/{id}', [BrandCategoryController::class, 'AddBrandCategoryDelete'])->name('delete');
});

   // Ashim bannerCategory  Route Group
   Route::prefix('bannerCategory')->middleware('routePermission')->group(function () {
    Route::get('/view', [BannerCatagoryController::class, 'BennarView'])->name('bannerCategory.manage');
    Route::post('/store', [BannerCatagoryController::class, 'BennarStore'])->name('bannerCategory.store');
    Route::get('/dalete{id}', [BannerCatagoryController::class, 'BennarDelete'])->name('bannerCategory.delete');
    Route::get('/edit/{id}', [BannerCatagoryController::class, 'BennarEdit'])->name('bannerCategory.edit');
    Route::post('/update', [BannerCatagoryController::class, 'BennarUpdate'])->name('bannerCategory.update');
    // for Deactive
    Route::get('/deactive/{id}', [BannerCatagoryController::class, 'BennarDeactive'])->name('bannerCategory.deactive');
    // for Active
    Route::get('/active/{id}', [BannerCatagoryController::class, 'BennarActive'])->name('bannerCategory.active');
});