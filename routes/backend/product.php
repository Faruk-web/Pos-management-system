<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubSubCategoryController;

// Admin Product Route Group
Route::prefix('product')->middleware('routePermission')->group(function () {


    // category auto select
    Route::get('/category/select/ajax/{category_id}', [ProductController::class, 'AutoSelectCategory']);
    // sub  category route
    Route::get('/subcategory/ajax/{category_id}', [SubSubCategoryController::class, 'GetSubCategory']);
    // sub sub category route
    Route::get('/subsubcategory/ajax/{category_id}', [SubSubCategoryController::class, 'GetSubsubCategory']);

    Route::get('/view', [ProductController::class, 'ProductAdd'])->name('product.add');
    Route::get('/details/view/{id}', [ProductController::class, 'ProductAllInfoView'])->name('product.all_info_view');
    Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product_store');
    // Manage Product
    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');
    // Add New Product
    Route::get('/newproduct', [ProductController::class, 'addNewProduct'])->name('new-product');
    // Edit Product
    Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');
    // Upadte Product
    Route::post('/update', [ProductController::class, 'UpdateProduct'])->name('product_update');

    // For Multiple Img Update
    Route::post('/update/multiimg', [ProductController::class, 'UpdateProductMultiImg'])->name('update_product_img');
    // for Multipart Deleted
    Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');
    Route::get('/get/barcode/{id}/{print_quantity}', [ProductController::class, 'Barcode'])->name('Get.barcode');
    //hot deals
    Route::get('/hot_deals', [ProductController::class, 'HotDeals'])->name('porduct.hotDeals');
    Route::get('/hot_deals/{id}', [ProductController::class, 'HotDealsID'])->name('porduct.hotDealsbyid');
    Route::post('/hot_deals/store', [ProductController::class, 'HotDealsStore'])->name('deals.store');
    // For Thambnail Img Update
    Route::post('/thambnail/update', [ProductController::class, 'ThambnailImageUpdate'])->name('update-product-thambnail');
    //===================================Product Active And Deactive========================================
    // for Deactive
    Route::get('/deactive/{id}', [ProductController::class, 'ProductDeactive'])->name('product.deactive');
    // for Active
    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');

    //===================================Product Delete========================================
    Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
    Route::get('/purshase-list/{purchase_id}', [ProductController::class, 'GetPurchase']);

    Route::get('/get/barcode/{id}/{print_quantity}', [ProductController::class, 'Barcode'])->name('Get.barcode');
    //=================================== new  Product count ========================================
    Route::get('/product/count', [ProductController::class, 'productCount'])->name('productCount');
    Route::post('/singleEcom/product/count', [ProductController::class, 'singleEcomProductCount'])->name('singleEcomProductCount');
});

// Admin Product Strock Routes
Route::prefix('stock/')->middleware('routePermission')->group(function () {
    Route::get('/product', [ProductController::class, 'ProductStock'])->name('product.stock');
}); // end Product Stock

// for search backend products
Route::get('admin/product/search/ajax/{adminId}/{value}', [ProductController::class, 'searchProductWithAjax']);
Route::get('admin/product/search/ajax/{userId}/{value}', [ProductController::class, 'searchProductWithAjax']);
