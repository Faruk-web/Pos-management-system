<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentPanelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use App\Http\Controllers\Backend\ListBrandController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\BannerCatagoryController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\EmployeeSalary;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\ShopOwnerController;
use App\Http\Controllers\Frontend\FashionController;
use App\Http\Controllers\SupplierDashboardController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\PosAgentController;
use App\Http\Controllers\Backend\EmployeeController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\IslamicController;
use App\Http\Controllers\Frontend\ElectronicController;
use App\Http\Controllers\Frontend\CosmeticController;
use App\Http\Controllers\Frontend\FurnitureController;
use App\Http\Controllers\Frontend\BabyController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\GroceryIndexController;
use App\Http\Controllers\Frontend\GroceryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\PageCartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\InformationController;
use App\Http\Controllers\Frontend\ImageController;
use App\Http\Controllers\Backend\AdminCartController;
use App\Http\Controllers\Backend\ManagerController;
use App\Http\Controllers\Frontend\SocialiteLoginController;
use App\Http\Controllers\Backend\PurchaseController;
use App\Http\Controllers\Backend\GeneralController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\CurrencyController;
use App\Http\Controllers\Backend\Social_Media_LoginController;
use App\Http\Controllers\Backend\ThirdPartySettingController;
use App\Http\Controllers\Backend\FileSystem_ConfigurationController;
use App\Http\Controllers\Backend\SMTPController;
use App\Http\Controllers\Backend\PaymentMethodController;
use App\Http\Controllers\Backend\PosCartController;
use App\Http\Controllers\Backend\ShippingCountriesController;
use App\Http\Controllers\Backend\ShippingStatesController;
use App\Http\Controllers\Backend\ShippingCitiesController;
use App\Http\Controllers\Backend\ShippingZoneController;



use App\Http\Controllers\Backend\CourierPanelController;
use App\Http\Controllers\Backend\MarchantController;


use App\Http\Controllers\Backend\TaxController;
use App\Http\Controllers\Backend\BrandCategoryController;
use App\Http\Controllers\Backend\SupplerPaymentHistoryController;
use App\Http\Controllers\EmployeerController;
use App\Http\Controllers\Backend\NewOrderController;
use App\Models\AgentPanel;
use App\Models\User;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use App\Http\Controllers\SslCommerzPaymentController;


Route::middleware(['auth'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard', compact('user'));
})->name('dashboard');

Route::get('/home',[HomeController::class, 'index'] )->name('home');
Route::get('/', [AdminController::class, 'loginForm'])->name('user.index');
Route::post('login',[UserController::class, 'login'] )->name('newlogin');

Route::post('loginWithOtp',[UserController::class, 'loginWithOtp'] )->name('loginWithOtp');
Route::post('loginWithEmail',[UserController::class, 'loginWithEmail'] )->name('loginWithEmail');
Route::get('loginWithOtp', function () {
    return view('auth/OtpLogin');
})->name('loginWithOtp.view');

Route::post('sendOtp',[UserController::class, 'sendOtp'] );
Route::post('newregister',[UserController::class, 'register'] )->name('newregister');
Route::get('/create/registration', [IndexController::class, 'createAccount'])->name('user.register'); //name('user.index')
// User Logout Route
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
// User Update Profile
Route::get('/user/profile/update', [IndexController::class, 'UserProfile'])->name('user.profile');
// user profile store
Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
// user Change Password
Route::get('/user/change/password', [IndexController::class, 'UserChnagePassword'])->name('change.password');
// user  Password Update
Route::get('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');

// Admin All Brands Route Group
// Admin prefix route
Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function () {
    // Admin Route
    Route::middleware(['auth:admin', 'verified','routePermission'])->get('/admin/dashboard', function () {
        if(Auth::guard('admin')->user()->supplier_id || Auth::guard('admin')->user()->employee_id || Auth::guard('admin')->user()->agent_id){
            return redirect()->back()->with('error',"You have no permission");
        }
        return view('admin.index');
    })->name('admin.dashboard')->middleware('auth:admin');
    Route::post('admin/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
});

// employeer prefix route
Route::group(['prefix'=> 'employeer', 'middleware'=>['employeer:employeer']], function(){
	Route::get('/login', [EmployeerController::class, 'loginForm'])->name('employeer.loginForm');
	Route::post('/login',[EmployeerController::class, 'store'])->name('employeer.login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware(array_filter([
        'guest:employeer'
    ]));
});

Route::middleware(['auth:employeer'])->group(function(){
    // employeer Route
    Route::get('/employeer/dashboard', function () {

        return view('admin.index');
    })->name('employeer.dashboard');

    Route::get('employeer/logout', [AuthenticatedSessionController::class, 'employeerDestroy'])->name('employeer.logout');

});


Route::prefix('/admin')->name('admin.')->group(function () {
    // admin profile route
    Route::get('/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin_profile_view');
      Route::get('/agent/profile', [AdminProfileController::class, 'AgentProfile'])->name('agent_profile_view');
    // admin profile Edit route
    Route::get('/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin_profile_edit');
    ////Admin Profile edit store route
    Route::post('/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('profile.store');
    ////Admin password change
    Route::get('/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin_change_password');
    ////Admin update password
    Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');
    ////Admin update password
    // Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');
});


Route::prefix('/{role}')->middleware('auth:'.config('fortify.guard'))->name('role.')->group(function () {
    //.................... Brand New crud with Jquery ....................//
    Route::prefix('brandnew')->name('brandnew.')->group(function () {
        Route::get('/add', [BrandController::class, 'BrandnewAdd'])->name('allbrand');
        Route::post('/store', [BrandController::class, 'BrandnewStore'])->name('store');
        Route::get('/view', [BrandController::class, 'BrandnewView'])->name('view');
        Route::get('/edit/{id}', [BrandController::class, 'BrandnewEdit'])->name('edit');
        Route::post('/update/{id}', [BrandController::class, 'BrandnewUpdate'])->name('update');
        Route::get('/delete/{id}', [BrandController::class, 'BrandnewDelete'])->name('delete');
    });

//======================================= Agent All Route Group List start ==================================//
    Route::prefix('agent')->middleware('routePermission')->name('agent_panel.')->group(function () {
            // Laboni Route==

          Route::get('/order/single/view/{id}',[AgentPanelController::class,'singleHistoryOrder'])->name('single_history_order');
          Route::get('/order/pos/view/{id}',[AgentPanelController::class,'OrderPosView'])->name('pos_order_view');
        //  Route::get('/single_orders/history/{id}', [AgentPanelController::class, 'singleOrderHistory'])->name('single_order_history');
        Route::get('/view',[AgentPanelController::class,'view'])->name('view');
        Route::get('/getAll',[AgentPanelController::class,'getAll'])->name('getAll');
        Route::post('/store',[AgentPanelController::class,'store'])->name('store');
        Route::get('/edit/{id}',[AgentPanelController::class,'edit'])->name('edit');
        Route::post('/update',[AgentPanelController::class,'update'])->name('update');
        Route::post('/destroy/{id}',[AgentPanelController::class,'destroy'])->name('destroy');

        Route::get('/dashboard', [AgentPanelController::class, 'dashboard'])->name('dashboard');
        Route::get('/add/customer', [AgentPanelController::class, 'addCustomer'])->name('add_customer');
        Route::post('/store/customer', [AgentPanelController::class, 'storeCustomer'])->name('store_customer');
        Route::get('/view/customer', [AgentPanelController::class, 'ViewCustomer'])->name('view_customer');
        Route::get('/order/history', [AgentPanelController::class, 'orderHistory'])->name('order_history');
         Route::get('/single_order/history/next/ajax/{order_id}', [AgentPanelController::class, 'singleOrderHistoryAjax2'])->name('single_order_history_ajax2');


        Route::get('/single_order/history/ajax/{id}', [AgentPanelController::class, 'singleOrderHistoryAjas'])->name('single_order_history_ajax');
        Route::get('/my/commission', [AgentPanelController::class, 'myCommision'])->name('my_commission');
        // end Laboni Route

        // new route start for apge panel
          Route::get('/shopping/start_shopping_agent', [AgentPanelController::class, 'startShoppingAgent'])->name('start_shopping_agent');
       // new route start for apge panel
    //   for shopping view
          Route::get('/order/details/{id}', [AgentPanelController::class, 'OrderDetails'])->name('order_details');


    });
//======================================= Agent All Route Group List End ==================================//

        //.................... Brand New crud with Jquery ....................//
    Route::prefix('brandcategory')->name('brandcategory.')->group(function () {
        Route::get('/add', [BrandCategoryController::class, 'AddBrandCategory'])->name('brandcategoryadd');
        Route::post('/store', [BrandCategoryController::class, 'AddBrandCategoryStore'])->name('store');
        Route::get('/view', [BrandCategoryController::class, 'AddBrandCategoryView'])->name('view');
        Route::get('/edit/{id}', [BrandCategoryController::class, 'AddBrandCategoryEdit'])->name('edit');
        Route::post('/update/{id}', [BrandCategoryController::class, 'AddBrandCategoryUpdate'])->name('update');
        Route::get('/delete/{id}', [BrandCategoryController::class, 'AddBrandCategoryDelete'])->name('delete');

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




    Route::prefix('subcategory')->name('subcategory.')->group(function () {
        Route::get('/view', [SubCategoryController::class, 'SubCategoryView'])->name('allsubcategory');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('store');
        Route::get('/fetchall', [SubCategoryController::class, 'fetchAll'])->name('fetchAll');
        Route::get('/delete/{id}', [SubCategoryController::class, 'delete'])->name('delete');
        Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SubCategoryController::class, 'update'])->name('update');

        Route::post('/active-deactive-subcategory/{id}', [SubCategoryController::class, 'activeDeactiveSubCategory'])->name('subCategoryActiveDeactive');

    });

    // Admin All Sub SUb Category Route Group
    Route::prefix('subsubcategory')->name('subsubcategory.')->group(function () {
        Route::get('/view', [BabyController::class, 'SubSubCategoryView'])->name('view');
        // sub sub category route
        Route::get('/subcategory/ajax/{category_id}', [SubSubCategoryController::class, 'GetSubCategory']);
        // sub category route
        Route::get('/subcategory/{category_id}', [SubSubCategoryController::class, 'getOnlySubCategory']);
        // sub category route
        Route::get('/subsubcategory/{subcategory}', [SubSubCategoryController::class, 'getOnlySubSubCategory']);
        // for auto select sub sub category route
        Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubSubCategoryController::class, 'GetSubSubCategory']);
        //Sub  Sub category store
        Route::post('/store', [SubSubCategoryController::class, 'store'])->name('store');
        Route::get('/fetchall', [SubSubCategoryController::class, 'fetchAll'])->name('fetchAll');
        Route::get('/delete/{id}', [SubSubCategoryController::class, 'delete'])->name('delete');
        Route::get('/edit/{id}', [SubSubCategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SubSubCategoryController::class, 'update'])->name('update');

        Route::post('/active-deactive-subsubcategory/{id}', [SubSubCategoryController::class, 'activeDeactiveSubSubCategory'])->name('subSubCategoryActiveDeactive');

    });


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


    // Slider  Route Group
    Route::prefix('slider')->middleware('routePermission')->group(function () {

        Route::get('/view', [SliderController::class, 'SliderView'])->name('manage.slider');

        Route::get('/slidersdata', [SliderController::class, 'showdata']);

        Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');

        Route::get('/edit/{id}', [SliderController::class, 'SliderEdit'])->name('slider.edit');

        Route::post('/update/{id}', [SliderController::class, 'SliderUpdate']);

        Route::post('/delete/{id}', [SliderController::class, 'SliderDelete']);

        //===================================Product Active And Deactive==================================
        // for Deactive
        Route::get('/deactive/{id}', [SliderController::class, 'SliderDeactive'])->name('slider.deactive');
        // for Active
        Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');
    });

    // Admin Coupon  Route Group
    Route::prefix('cupons')->middleware('routePermission')->group(function () {

        Route::get('/view', [CouponController::class, 'CouponView'])->name('manage.coupon');

        Route::post('/store', [CouponController::class, 'CouponStore'])->name('coupon.store');

        Route::get('/edit/{id}', [CouponController::class, 'CouponEdit'])->name('coupon.edit');

        Route::post('/update/{id}', [CouponController::class, 'CouponUpdate'])->name('coupon.update');

        Route::get('/delete/{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');
    }); // end coupon prefix


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
         Route::post('subcategorybanner/store', [BannerController::class,'SubCatBannerStore'])->name('subcategorybanner.store');
        Route::get('/subcategorybanner/edit/{id}', [BannerController::class,'SubCatBannerEdit'])->name('subcategorybanner.edit');
        Route::post('/subcategorybanner/update/{id}', [BannerController::class,'SubCatBannerUpdate'])->name('subcategorybanner.update');
        Route::get('/subcategorybanner/dalete/{id}',[BannerController::class,'SubCatBannerDelete'])->name('subcategorybanner.delete');
          // shop now  banner store
        Route::post('shopnowbanner/store', [BannerController::class, 'ShopNowStore'])->name('shopnowbanner.store');
        Route::get('/shopnowbanner/edit/{id}',[BannerController::class,'ShopNowEdit'])->name('shopnowbanner.edit');
        Route::post('/shopnowbanner/update', [BannerController::class,'ShopNowUpdate'])->name('shopnowbanner.update');
        Route::post('/shopnowbanner/update/{id}',[BannerController::class,'ShopNowUpdate'])->name('ShopNowbanner.update');
         Route::get('/shopnowbanner/dalete/{id}',[BannerController::class,'ShopNowDelete'])->name('ShopNowbanner.delete');
        //
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
    // 5050
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
    // Admin Orders  Route Group
    Route::prefix('orders')->middleware('routePermission')->group(function () {

        // pending order view
        Route::get('/pending/orders', [OrderController::class, 'PendingOrder'])->name('pending.orders');
        // Pending Orders Details
        Route::get('/pending/orders/details/{order_id}', [OrderController::class, 'PendingOrdersDetails'])->name('pending.orders.details');

        //pending delivery code generate
        Route::get('/get/deliverycode/{id}/{print_quantity}', [OrderController::class, 'DeliveryCode'])->name('Get.deliverycode');

        // Confirmed Orders
        Route::get('/confirmed/orders', [OrderController::class, 'ConfirmedOrders'])->name('confirmed-orders');
        Route::get('/processing/orders', [OrderController::class, 'ProcessingOrders'])->name('confirm-processing');
        Route::get('/picked/orders', [OrderController::class, 'PickedOrders'])->name('picked-orders');

        Route::get('/shipped/orders', [OrderController::class, 'ShippedOrders'])->name('shipped-orders');

        Route::get('/delivered/orders', [OrderController::class, 'DeliveredOrders'])->name('delivered-orders');

        Route::get('/cancel/orders', [OrderController::class, 'CancelOrders'])->name('cancel-orders');

        Route::get('/invoice/print/{order}', [OrderController::class, 'InvoicePrintBpp'])->name('inv_print');


        // update route all
        //for confirm
        Route::get('/pending/confirm/{order_id}', [OrderController::class, 'PendingToConfirm'])->name('pending-confirm');
        // fro processing
        Route::get('/confirm/processing/{order_id}', [OrderController::class, 'ConfirmToProcessing'])->name('confirm.processing');
        // for  picdate
        Route::get('/processing/picked/{order_id}', [OrderController::class, 'ProcessingToPicked'])->name('processing.picked');
        // for shiped
        Route::get('/picked/shipped/{order_id}', [OrderController::class, 'PickedToShipped'])->name('picked.shipped');

        // for delevery
        Route::get('/shipped/delivered/{order_id}', [OrderController::class, 'ShippedToDelivered_20'])->name('shipped.delivered');
        // for cancel
        Route::get('/delivered/cancel/{order_id}', [OrderController::class, 'DeliveredToCancel'])->name('delivered.cancel');
        // Order Invoice Download
        Route::get('/invoice/download/{order_id}', [OrderController::class, 'AdminInvoiceDownload'])->name('invoice.download');
    }); // end coupon prefix

    // Admin Product Strock Routes
    Route::prefix('stock/')->middleware('routePermission')->group(function () {
        Route::get('/product', [ProductController::class, 'ProductStock'])->name('product.stock');
    }); // end Product Stock

    // Admin All user role###########################################################################
    Route::prefix('adminuserrole')->middleware('routePermission')->group(function () {
           Route::get('/all', [AdminUserController::class, 'AllAdminRole'])->name('all.admin.user');
        Route::get('/add', [AdminUserController::class, 'AddAdminRole'])->name('add.admin');
        Route::get('/emp.permision', [AdminUserController::class, 'EmpPermison'])->name('emp.permision');
        Route::get('/sup.permision', [AdminUserController::class, 'SupPermison'])->name('sup.permision');
        Route::post('/store', [AdminUserController::class, 'StoreAdminRole'])->name('admin.user.store');
        Route::post('/employee/permision/store', [AdminUserController::class, 'employeePermissionSotre'])->name('emp.permision.store');

        Route::get('/shopOwner_permision', [AdminUserController::class, 'shopOwnerPermission'])->name('shopOwner.permision');
        Route::post('/shopOwner_permision/store', [AdminUserController::class, 'shopOwnerPermissionStore'])->name('shopOwner.permision.store');


        Route::get('/agent_panel', [AdminUserController::class, 'AgentPermission'])->name('agent_panel.permision');
        Route::post('/agent_panel/store', [AdminUserController::class, 'AgentPermissionStore'])->name('agent_panel.permision.store');

        Route::get('/manager_panel', [AdminUserController::class, 'ManagerPermission'])->name('manager_panel.permision');
        Route::post('/manager_panel/store', [AdminUserController::class, 'ManagerPermissionStore'])->name('manager_panel.permision.store');

        Route::post('/supplier/store', [AdminUserController::class, 'StoreSupplierRole'])->name('admin.supplier.store');
        Route::get('/edit/{id}', [AdminUserController::class, 'EditAdminRole'])->name('edit.admin.user');
        Route::post('/update', [AdminUserController::class, 'UpdateAdminRole'])->name('admin.user.update');
        Route::get('/employee/edit/{id}', [AdminUserController::class, 'EditEmployeeRole'])->name('edit.employee.user');

        Route::post('/employee/update', [AdminUserController::class, 'updateEmployeePermission'])->name('employee.user.update');
        Route::get('/delete/{id}', [AdminUserController::class, 'DeleteAdminRole'])->name('delete.admin.user');
    }); // All user role

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




    /// ===================================== manager panel route new=============================================
    Route::prefix('manager')->name('manager_panel.')->middleware('routePermission')->group(function () {
        Route::get('/dashboard_manager', [ManagerController::class, 'managerDashboard'])->name('manager_dashboard');
        Route::get('/agent/commission', [ManagerController::class, 'agentCommission'])->name('agent_commission');
        // payment statemnt
         Route::get('/agent/commission/payment/view/data/{id}', [ManagerController::class, 'agentCommissionPaymentViewData'])->name('agent_commission_payment_view_data');
        Route::post('/agent/commission/payment/{id}', [ManagerController::class, 'agentCommissionPayment'])->name('agent_commission_payment');
         Route::get('/agent/commission/payment/view/{id}', [ManagerController::class, 'agentCommissionPaymentview'])->name('agent_commission_payment_view');
        // payment statement end
        Route::get('/agent/order', [ManagerController::class, 'agentOrderHistory'])->name('agent_order_history');
        Route::get('/addManager', [ManagerController::class, 'index'])->name('manager');
        Route::get('/agentManagerEdit/{agent_id}', [ManagerController::class, 'agentManagerEdit']);
        Route::post('/agentManagerUpdate/{agent_id}', [ManagerController::class, 'agentManagerUpdate']);


        Route::get('/Manager/list', [ManagerController::class, 'ManagerView'])->name('ManagerView');
        Route::post('/managerStore', [ManagerController::class, 'managerStore'])->name('managerStore');
        Route::get('/show/customer', [ManagerController::class, 'addShow'])->name('addShow');
        Route::get('/delete/customer/{id}', [ManagerController::class, 'deleteCustomer'])->name('deleteCustomer');
        // Route::get('/order/history', [AgentPanelController::class, 'orderHistory'])->name('order_history');
        // Route::get('/my/commission', [AgentPanelController::class, 'myCommision'])->name('my_commission');

         Route::get('/Manager/customer', [ManagerController::class, 'customerList'])->name('customerList');

         // customer all order list
         Route::get('/agent/all/customer/order/list/{order_id}', [ManagerController::class, 'AgentOrdercustomerList'])->name('all_customer_order');


    });

    // Admin Get All User Routes
    Route::prefix('alluser')->middleware('routePermission')->group(function () {
        // All user view
        Route::get('/view', [AdminProfileController::class, 'AllUsers'])->name('all-users');
        Route::get('/show/{id}', [AdminProfileController::class, 'show'])->name('all-users-show');
        Route::get('/oderitemlist/{id}',[AdminProfileController::class,'userItemList'])->name('orderitemlist');
        Route::get('/invoice/download/{id}', [AdminProfileController::class, 'userItemInvoiveDownload'])->name('invoicedownload');
    }); // end user Get


    Route::prefix('return')->middleware('routePermission')->group(function () {
        // Return Request Show
        Route::get('/admin/request', [ReturnController::class, 'ReturnRequest'])->name('return.request');
        // Return Request Approve
        Route::get('/admin/return/approve/{order_id}', [ReturnController::class, 'ReturnRequestApprove'])->name('return.approve');
        // Return All Request
        Route::get('/admin/all/request', [ReturnController::class, 'ReturnAllRequest'])->name('all.request');
    });

    // Admin Site Setting Routes (logo, social link etc)
    Route::prefix('setting')->middleware('routePermission')->group(function () {
        // view
        Route::get('/site', [SiteSettingController::class, 'SiteSetting'])->name('site.setting');
        // update
        Route::post('/site/update', [SiteSettingController::class, 'SiteSettingUpdate'])->name('update.sitesetting');
        // Seo
        Route::get('/seo', [SiteSettingController::class, 'SeoSetting'])->name('seo.setting');
        // Seo Meta data
        Route::post('/seo/update', [SiteSettingController::class, 'SeoSettingUpdate'])->name('update.seosetting');
    });


    //   Shop Owner Route List
        Route::prefix('shop_owner')->name('shop_owner.')->group(function()
        {
            Route::get('/view',[ShopOwnerController::class,'view'])->name('view');
            Route::get('/getAll',[ShopOwnerController::class,'getAll'])->name('getAll');
            Route::post('/store',[ShopOwnerController::class,'store'])->name('store');
            Route::get('/edit/{id}',[ShopOwnerController::class,'edit'])->name('edit');
            Route::post('/update',[ShopOwnerController::class,'update'])->name('update');
            Route::post('/destroy/{id}',[ShopOwnerController::class,'destroy'])->name('destroy');

              //new owner route
            Route::get('dashboard/view',[ShopOwnerController::class,'dashboard'])->name('dashboard');
            Route::get('paymentHistory/view',[ShopOwnerController::class,'paymentHistory'])->name('paymentHistory');
            Route::get('ownerProductList/view',[ShopOwnerController::class,'ownerProductList'])->name('ownerProductList');
            Route::get('profitReport/view',[ShopOwnerController::class,'profitReport'])->name('profitReport');
            Route::get('ownerReturnProduct/view',[ShopOwnerController::class,'ownerReturnProduct'])->name('ownerReturnProduct');

            Route::get('ownerSupplierList/view',[ShopOwnerController::class,'ownerSupplierList'])->name('ownerSupplierList');
            Route::post('/owner/insertData', [ShopOwnerController::class, 'ownerStore'])->name('ownerStore');
            // Route::get('/supplier/all', [ShopOwnerController::class, 'SupplierDataShowAll']);
            Route::get('/owner/delete/{id}', [ShopOwnerController::class, 'SupplierDataDeleteAll']);
            // Route::get('/supplier/edit/{id}', [ShopOwnerController::class, 'SupplierEditAll']);
            // Route::post('/supplier/updateData/{id}', [ShopOwnerController::class, 'SupplierUpdateAll']);

                //owner shop return product route
            Route::get('/ownerreturnproduct/show/{id}',[ShopOwnerController::class,'returnProductGet']);
            Route::post('/ownerreturnproduct/insert',[ShopOwnerController::class,'returnProductCeate']);


        });
    // End Shop Owner Route List


    // Admin Coupon  Route Group
    Route::prefix('shipping')->group(function () {


        /// ship Division
        Route::get('/division/view', [ShippingAreaController::class, 'DivisionView'])->name('manage.division');

        Route::post('/division/store', [ShippingAreaController::class, 'DivisionStore'])->name('division.store');

        Route::get('/division/edit/{id}', [ShippingAreaController::class, 'DivisionEdit'])->name('division.edit');

        Route::post('/division/update/{id}', [ShippingAreaController::class, 'DivisionUpdate'])->name('division.update');

        Route::get('/division/delete/{id}', [ShippingAreaController::class, 'DivisionDelete'])->name('division.delete');

        /// ship District
        Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage.district');
        /// ship District
        Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage.district');
        Route::post('/district/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');
        Route::get('/district/edit/{id}', [ShippingAreaController::class, 'DistrictEdit'])->name('district.edit');
        Route::post('/district/update/{id}', [ShippingAreaController::class, 'DistricUpdate'])->name('district.update');
        Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistricDelete'])->name('district.delete');
        Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistricDelete'])->name('district.delete');
        /// Ship State
        Route::get('/state/view', [ShippingAreaController::class, 'StateView'])->name('manage.state');
        Route::post('/state/store', [ShippingAreaController::class, 'StateStore'])->name('state.store');
        Route::get('/state/edit/{id}', [ShippingAreaController::class, 'StateEdit'])->name('state.edit');
        Route::post('/state/update/{id}', [ShippingAreaController::class, 'StateUpdate'])->name('state.update');
        Route::get('/state/delete/{id}', [ShippingAreaController::class, 'StateDelete'])->name('state.delete');    });

    //  General Setting
    Route::prefix('general_setting')->group(function () {
        Route::get('/view', [GeneralController::class, 'GeneralAdd'])->name('general_setting.view');
    });


    //  Language Setting
    Route::prefix('language')->group(function () {
        Route::get('/view', [LanguageController::class, 'LanguageAdd'])->name('laguage.view');
        Route::get('/information_view', [LanguageController::class, 'Language_InformationAdd'])->name('laguage_information.view');
    });


    //  Currency Setting
    Route::prefix('currency')->group(function () {
        Route::get('/view', [CurrencyController::class, 'CurrencyAdd'])->name('currency.view');
        Route::get('/currency_information_view', [CurrencyController::class, 'Currency_InfoAdd'])->name('currency_information.view');
    });


    // SMTP
    Route::prefix('smtp')->group(function () {
        Route::get('/view', [SMTPController::class, 'SMTP_Add'])->name('smtp.view');
    });


    // Payment Method
    Route::prefix('payment_method')->group(function () {
        Route::get('/view', [PaymentMethodController::class, 'PaymentMethodAdd'])->name('payment_method.view');
    });


    // File System Configuration
    Route::prefix('file_system_configuration')->group(function () {
        Route::get('/view', [FileSystem_ConfigurationController::class, 'FileSystem_Configuration_Add'])->name('file_system_configuration.view');
    });


    //  Social Media Login
    Route::prefix('social_media_login')->group(function () {
        Route::get('/view', [Social_Media_LoginController::class, 'SocialMediaLogin_Add'])->name('social_media_login.view');
    });


    //  Third Party Setting
    Route::prefix('third_party_setting')->group(function () {
        Route::get('/view', [ThirdPartySettingController::class, 'ThirdPartySetting_Add'])->name('third_party_setting.view');
    });


    //  Shipping Countries
    Route::prefix('shipping_countries')->group(function () {
        Route::get('/view', [ShippingCountriesController::class, 'Shipping_CountriesAdd'])->name('shipping_countries.view');
    });


    //  Shipping States
    Route::prefix('shipping_states')->group(function () {
        Route::get('/view', [ShippingStatesController::class, 'Shipping_StatesAdd'])->name('shipping_states.view');
    });


    //  Shipping Cities
    Route::prefix('shipping_cities')->group(function () {
        Route::get('/view', [ShippingCitiesController::class, 'ShippingCitiesAdd'])->name('shipping_cities.view');
    });
    // Shipping Zone & Shipping Information
    Route::prefix('shipping_zone')->group(function () {
        Route::get('/view', [ShippingZoneController::class, 'ShippingZoneAdd'])->name('shipping_zone.view');
        Route::get('/information_view', [ShippingZoneController::class, 'ShippingZoneInformationAdd'])->name('shipping_zone.information_view');
    });



    // Tax
    Route::prefix('tax')->group(function () {
        Route::get('/view', [TaxController::class, 'TaxAdd'])->name('tax.view');
    });


    // Admin Reports Routes
    Route::prefix('reports')->middleware('routePermission')->group(function () {
        Route::get('/view', [ReportController::class, 'ReportView'])->name('all-reports');
        // Search Date Report
        Route::post('/search/by/date', [ReportController::class, 'ReportByDate'])->name('search-by-date');
        // Search Month Report
        Route::post('/search/by/month', [ReportController::class, 'ReportByMonth'])->name('search-by-month');
        // Search Year Report
        Route::post('/search/by/year', [ReportController::class, 'ReportByYear'])->name('search-by-year');
        //sallery report
        route::get('/sallary-view', [ReportController::class, 'SalaryReportView'])->name('sallary-report-view');
        route::post('/sallary', [ReportController::class, 'SalaryReport'])->name('sallary-report');
        //return report

        route::get('/return-product-view', [ReportController::class, 'returnReportView'])->name('return-report-view');
        route::post('/return-product', [ReportController::class, 'returnReport'])->name('return-report');

        //sallery report
        route::get('/user-activity-view', [ReportController::class, 'UserActivityReportView'])->name('User-activity-view');
        route::get('/user-activity', [ReportController::class, 'UserActivityReport'])->name('User-activity-report');

        route::get('/profitreport', [ReportController::class, 'ProfitReportView'])->name('profit.report');
        route::post('/profitreport/day', [ReportController::class, 'ProfitReportDay'])->name('profit.day');
        route::post('/profitreport/month', [ReportController::class, 'ProfitReportMonth'])->name('profit.month');
        route::post('/profitreport/year', [ReportController::class, 'ProfitReportYear'])->name('profit.year');

        // purchase report
        route::get('/purchasereport', [ReportController::class, 'PurchaseReportView'])->name('purchase.report');
        route::post('/purchasereport/store', [ReportController::class, 'PurchaseReportStore'])->name('purchase.report.store');
        route::get('/purchasereport/view', [ReportController::class, 'PurchaseReportViews'])->name('purchase.report.view');

        // sales report
        route::get('/salesreport', [ReportController::class, 'SaleReportView'])->name('sale.report');
        // Search Date Report
        Route::post('/sale/search/by/date', [ReportController::class, 'SaleReportByDate'])->name('sale-search-by-date');
        // Search Month Report
        Route::post('/sale/search/by/month', [ReportController::class, 'SaleReportByMonth'])->name('sale-search-by-month');
        // Search Year Report
        Route::post('/sale/search/by/year', [ReportController::class, 'SaleReportByYear'])->name('sale-search-by-year');
        route::get('/sale/salesreport/view', [ReportController::class, 'SaleReportShow'])->name('sale.report.show');

         // Category Wise Product Report
        route::get('/catwiseproductreport', [ReportController::class, 'CatWiseProReportView'])->name('catwiseproduct.report');
        route::post('/catwiseproductreport/get', [ReportController::class, 'getCatWiseProReport'])->name('getcatwiseproduct.report');

        //Product Stock Report
        route::get('/productstockreport',[ReportController::class,'productstockreport'])->name('gy.report');
        route::post('/getproductstockreport',[ReportController::class,'getproductstock'])->name('getstock.report');
    });  // end Reports



    Route::prefix('department')->group(function () {
        Route::get('/view', [DepartmentController::class, 'DepartmentView'])->name('department.view');
        Route::post('/store', [DepartmentController::class, 'DepartmentStore'])->name('department.store');
        Route::post('/edit', [DepartmentController::class, 'DepartmentEdit'])->name('department.edit');
        Route::post('/update', [DepartmentController::class, 'DepartmentUpdate'])->name('department.update');
        Route::delete('/delete/{id}', [DepartmentController::class, 'DepartmentDelete'])->name('department.delete');
    });
    Route::prefix('expense')->middleware('routePermission')->group(function () {
        Route::get('/addview', [ExpenseController::class, 'ExpenseView'])->name('expense.add');
        Route::get('/list', [ExpenseController::class, 'ExpenseList'])->name('expense.list');
        Route::post('/store', [ExpenseController::class, 'ExpenseStore'])->name('expense.store');
        Route::get('/edit/{id}', [ExpenseController::class, 'ExpenseEdit'])->name('expense.edit');
        Route::post('/update', [ExpenseController::class, 'ExpenseUpdate'])->name('expense.update');
        Route::post('/addexpensetype', [ExpenseController::class, 'AddecpenseType'])->name('add.expnse.type');
        Route::get('/getexpensetype', [ExpenseController::class, 'GetExpenseType'])->name('get.expnse.type');
        Route::get('/report', [ExpenseController::class, 'GanerateReport'])->name('report.expense');
    });


    //  Pos Route Group Ashim Pos
    Route::prefix('pos')->middleware('routePermission')->group(function () {
        Route::get('/pos', [PosController::class, 'pos'])->name('pos');
        Route::get('/search/{id}', [PosController::class, 'search']);
        Route::get('/product/list/{categorie_id}', [PosController::class, 'PosProductList'])->name('product.list');
        Route::get('/brand/product/list/{brand_id}', [PosController::class, 'PosBrandProductList'])->name('brand.product.list');
        Route::post('/carts/add/{product_id}', [PosCartController::class, 'addProductToCart'])->name('pos.product.add');
    });




    // Agent Pos All Route
    Route::prefix('pos_agent')->group(function () {
        Route::get('/pos', [PosAgentController::class, 'Pos'])->name('pos_agent');
        Route::get('/search/{id}', [PosAgentController::class, 'search']);
        Route::get('/product/list/{categorie_id}', [PosAgentController::class, 'PosProductList'])->name('agent_product.list');
        Route::get('/brand/product/list/{brand_id}', [PosAgentController::class, 'PosBrandProductList'])->name('agent_brand.product.list');
        Route::post('/carts/add/{product_id}', [PosCartAgentController::class, 'addProductToCart'])->name('pos_agent.product.add');
    });

    // for department employee salary
    Route::prefix('salary')->middleware('routePermission')->group(function () {

        Route::get('/add', [EmployeeSalary::class, 'AddSalary'])->name('salary-add');
        Route::get('/get_employee/{id}', [EmployeeSalary::class, 'getEmployee'])->name('get.employee');
        Route::post('/get_employee', [EmployeeSalary::class, 'find'])->name('employee.find');
        Route::post('/salary_payment', [EmployeeSalary::class, 'getSalary'])->name('payment_salary');
        Route::get('/paid_salary', [EmployeeSalary::class, 'paidSalary'])->name('paid_salary');
    });

    // purchase routes
    Route::prefix('purchase')->group(function () {
        // All purchase  view
        Route::get('/view', [PurchaseController::class, 'PurchaseView'])->name('purchase.view');
        Route::get('/add', [PurchaseController::class, 'AddPurchase'])->name('purchase.add');
        Route::post('/store', [PurchaseController::class, 'PurchaseStore'])->name('purchase.store');
        Route::get('/delete/{id}', [PurchaseController::class, 'PurchaseDelete'])->name('purchase.delete');
        // Edit purchase
        Route::get('/edit/{id}', [PurchaseController::class, 'PurchaseEdit'])->name('purchase.edit');
        // Upadte purchase
        Route::post('/update', [PurchaseController::class, 'PurchaseUpdate'])->name('purchase.update');
        //Employee Full View
        Route::get('/details/{id}', [PurchaseController::class, 'PurchaseDetails'])->name('purchase.details');
        Route::get('/qty/{id}', [PurchaseController::class, 'qty']);
        Route::get('/getCategoryByProduct/{product}', [PurchaseController::class, 'getCategoryByProduct']);
    });

    Route::prefix('employeer')->middleware('routePermission')->group(function () {
        Route::get('/view', [EmployeeController::class, 'EmployeeView'])->name('employee.view');
        Route::get('/addform', [EmployeeController::class, 'EmployeeAddForm'])->name('employee.addform');
        Route::post('/store', [EmployeeController::class, 'EmployeeStore'])->name('employee.store');
        // Edit Employee
        Route::get('/edit/{id}', [EmployeeController::class, 'EmployeeEdit'])->name('employee.edit');
        // Upadte Employee
        Route::post('/update', [EmployeeController::class, 'EmployeeUpdate'])->name('employee.update');

        //Employee Full View
        Route::get('/details/{id}', [EmployeeController::class, 'EmployeeDetails'])->name('employee.details');

        Route::get('/delete/{id}', [EmployeeController::class, 'EmployeetDelete'])->name('employee.delete');

        //Employee Tracking System
        Route::get('/activity', [EmployeeController::class,'EmployeeTracking'])->name('empActivity.count');

        // Employee All Multi File route
           // For Multiple Img Update
        Route::post('/update/multiimg', [EmployeeController::class, 'UpdateEmployeeMultiImg'])->name('update_employee_img');
        // for Multipart Deleted
        Route::get('/multiimg/delete/{id}', [EmployeeController::class, 'MultiImageDelete'])->name('employee.multiimg.delete');



            //======================= tracking  employee route start===================
        Route::get('/trackingHistory', [EmployeeController::class, 'trackingHistory'])->name('trackingHistory');
        Route::get('/addTrackingHistory/{id}', [EmployeeController::class, 'addTrackingHistory'])->name('addTrackingHistory');
        Route::get('/updateTrackingHistory/{id}', [EmployeeController::class, 'updateTrackingHistory'])->name('updateTrackingHistory');
        Route::get('/deleteTrackingHistory/{id}', [EmployeeController::class, 'deleteTrackingHistory'])->name('deleteTrackingHistory');


    });

//====================== Courier Panel All Route Group start ===========================
Route::prefix('courrier_panel')->group(function () {
    // Courier Dashboard
    Route::get('/courier-panel', [CourierPanelController::class, 'CourierDashboard'])->name('courierDashboardPanel_new');
    // Courier MerchantList
    Route::get('/merchant/list', [CourierPanelController::class, 'MerchantListNew'])->name('new_all_merchant_list');
    Route::get('/merchant/add', [MarchantController::class, 'MerchantListAdd'])->name('MerchantListAdd');
    Route::post('/merchant/category/add', [MarchantController::class, 'MarchantControllerStoreData'])->name('MarchantControllerStoreData');
    Route::get('/merchant/category/all/show', [MarchantController::class, 'MarchantControllerShowData']);
    Route::get('/merchant/business/delete/{business_id}', [MarchantController::class, 'MarchantControllerDeleteData']);
    Route::get('/merchant/business/edit/{business_edit_id}', [MarchantController::class, 'MarchantControllerEditData']);
    Route::post('/merchant/business/updateData/{business_edits_id}', [MarchantController::class, 'MarchantControllerUpdateData']);

    // Merchant Package List
    Route::get('/merchant/package/list', [MarchantController::class, 'MerchantPackageList'])->name('merchant_package_list');
    Route::post('/merchant/package/category/add', [MarchantController::class, 'MarchantControllerPackageStoreData'])->name('MarchantControllerStoreData');
    Route::get('/merchant/package/category/all/show', [MarchantController::class, 'MarchantControllerPackageShowData']);
    Route::get('/merchant/package/business/delete/{business_id}', [MarchantController::class, 'MarchantControllerPackageDeleteData']);
    Route::get('/merchant/package/business/edit/{business_edit_package_id}', [MarchantController::class, 'MarchantControllerPackageEditData']);
    Route::post('/merchant/package/business/update/{business_edits_ids}', [MarchantController::class, 'MarchantControllerPackageUpdateData']);


    // Sen By Merchant Parcel List
    Route::get('/merchant/send/merchant/percel/list', [CourierPanelController::class, 'SendByMerchantPercelList'])->name('sendbymerchantpercellist');
       // All Parcel Received List from Merchant
    Route::get('/merchant/parcel/received/', [CourierPanelController::class, 'AllParcelReceivedListFromMerchant'])->name('all_parcel_received_list_from_merchant');
    // All Package Details List from Merchant
    Route::get('/merchant/package/details/', [CourierPanelController::class, 'AllPackageDetailsListfromMerchant'])->name('all_package_details_frommerchant');
     // Zone Wise Vehicle & Driver Confirmation List
    Route::get('/merchant/zone/vehicle_river_onfirmation_list/', [CourierPanelController::class, 'VehicleDriverConfirmationList'])->name('vehicle_driver_confirmationlist');

      // Zone Supervisor Parcel Receive from Driver
    Route::get('/merchant/zone/supervisor_rarcel_receive_driver/', [CourierPanelController::class, 'ZoneSupervisorParcelReceiveDriver'])->name('zone_supervisor_parcel_receive_driver');
      // Zone Wise Packages Delivery Complete List
    Route::get('/merchant/zone/zone_wise_packages_delivery_complete/', [CourierPanelController::class, 'ZoneWisePackagesDeliveryComplete'])->name('zone_wise_ackages_delivery_complete');
      // All Zone Payment Received & Deposit Statement
    Route::get('/merchant/allzone/payment_received_deposit_statement/', [CourierPanelController::class, 'PaymentReceivedDepositStatement'])->name('payment_received_deposit_statement');

    //Business Category route
    Route::get('/merchant/business/category/show', [MarchantController::class, 'ShowCatgoryBusiness'])->name('merchant.businesscategory');
    Route::post('/category/add', [MarchantController::class, 'MarchantControllerStore']);
    Route::get('/category/all/show', [MarchantController::class, 'MarchantControllerShow']);
    Route::get('/business/delete/{business_id}', [MarchantController::class, 'MarchantControllerDelete']);
    Route::get('/business/edit/{business_edit_id}', [MarchantController::class, 'MarchantControllerEdit']);
    Route::post('/business/updateData/{business_edits_id}', [MarchantController::class, 'MarchantControllerUpdate']);

});

// ===================== Courier Panel All Route Group End =============================



    // =========================== New Order Panel Start =============================================

    Route::prefix('order')->middleware('routePermission')->name('order.')->group(function()
    {
        Route::get('/allOrdersList',[NewOrderController::class,'allOrderList'])->name('getAllOrderList');
        Route::get('/pendingOrdersList',[NewOrderController::class,'pendingOrderList'])->name('pendingOrdersList');
        Route::get('/confirmedOrdersList',[NewOrderController::class,'confirmedOrdersList'])->name('confirmedOrdersList');
        Route::get('/processingOrdersList',[NewOrderController::class,'processingOrdersList'])->name('processingOrdersList');
        Route::get('/pickedOrdersList',[NewOrderController::class,'pickedOrdersList'])->name('pickedOrdersList');
        Route::get('/pickedOrdersProcessingList',[NewOrderController::class,'pickedOrdersProcessingList'])->name('pickedOrdersProcessingList');
        Route::get('/pickedOrdersCompleteList',[NewOrderController::class,'pickedOrdersCompleteList'])->name('pickedOrdersCompleteList');
        Route::get('/readyToShipList',[NewOrderController::class,'readyToShipList'])->name('readyToShipList');
        Route::get('/cancelOrderList',[NewOrderController::class,'cancelOrderList'])->name('cancelOrderList');


        Route::get('/allOrdersDetails/{order_id}',[NewOrderController::class,'allOrdersDetails'])->name('allOrdersDetails');
        Route::get('/pendingOrdersDetails/{order_id}',[NewOrderController::class,'pendingOrdersDetails'])->name('pendingOrdersDetails');
        Route::get('/confirmOrdersDetails/{order_id}',[NewOrderController::class,'confirmOrdersDetails'])->name('confirmOrdersDetails');
        Route::get('/processingOrdersDetails/{order_id}',[NewOrderController::class,'processingOrdersDetails'])->name('processingOrdersDetails');
        Route::get('/cancelOrdersDetails/{order_id}',[NewOrderController::class,'cancelOrdersDetails'])->name('cancelOrdersDetails');




        Route::get('/setStatusToConfirm/{order_id}',[NewOrderController::class,'setStatusToConfirm'])->name('setStatusToConfirm');
        Route::get('/setStatusToCancel/{order_id}',[NewOrderController::class,'setStatusToCancel'])->name('setStatusToCancel');
        Route::get('/setStatusToProcessing/{order_id}',[NewOrderController::class,'setStatusToProcessing'])->name('setStatusToProcessing');
        Route::get('/setStatusToPicked/{order_id}',[NewOrderController::class,'setStatusToPicked'])->name('setStatusToPicked');



        Route::POST('/setOrderItemStatus',[NewOrderController::class,'setOrderItemStatus'])->name('setOrderItemStatus');
        Route::POST('/setEmployeeToConfirmOrderProcessing',[NewOrderController::class,'setEmployeeToConfirmOrderProcessing'])->name('setEmployeeToConfirmOrderProcessing');
        Route::POST('/setEmployeeToPickedOrder',[NewOrderController::class,'setEmployeeToPickedOrder'])->name('setEmployeeToPickedOrder');
        Route::POST('/setStatusToPickedComplete/',[NewOrderController::class,'setStatusToPickedComplete'])->name('setStatusToPickedComplete');
        Route::POST('/setEmployeeToCheckedItems/',[NewOrderController::class,'setEmployeeToCheckedItems'])->name('setEmployeeToCheckedItems');
        Route::POST('/setReadyToShippedStatus/',[NewOrderController::class,'setReadyToShippedStatus'])->name('setReadyToShippedStatus');


        //get the number of employee assigned to item
        Route::get('/checkEmployeeAssignedToAllItem/{order_id}',[NewOrderController::class,'checkEmployeeAssignedToAllItem'])->name('checkEmployeeAssignedToAllItem');
        Route::get('/checkPickBoyAssignedToAllItem/{order_id}',[NewOrderController::class,'checkPickBoyAssignedToAllItem'])->name('checkPickBoyAssignedToAllItem');


        // employee order processing route

        Route::get('/employeeOrderProcessingList',[NewOrderController::class,'employeeOrderProcessingList'])->name('employeeOrderProcessing');
        Route::get('/employeeOrderProcessingDetails/{order_id}',[NewOrderController::class,'employeeOrderProcessingDetails'])->name('employeeOrderProcessingDetails');
        Route::POST('/employeeOrderProcessingStatusSet',[NewOrderController::class,'employeeOrderProcessingStatusSet'])->name('employeeOrderProcessingStatusSet');

        Route::get('/pickUpBoyOrderProcessing',[NewOrderController::class,'pickUpBoyOrderProcessing'])->name('pickUpBoyOrderProcessing');
        Route::get('/pickUpBoyOrderProcessingDetails/{order_id}',[NewOrderController::class,'pickUpBoyOrderProcessingDetails'])->name('pickUpBoyOrderProcessingDetails');
        Route::POST('/pickUpBoyOrderProcessingStatusSet',[NewOrderController::class,'pickUpBoyOrderProcessingStatusSet'])->name('pickUpBoyOrderProcessingStatusSet');

        Route::get('/singleSupplierInvoice/{employee_id}',[NewOrderController::class,'singleSupplierInvoice'])->name('singleSupplierInvoice');

        Route::get('/pickedSupplierItemDetails/{supplier_id}/{employee_id}',[NewOrderController::class,'pickedSupplierItemDetails'])->name('pickedSupplierItemDetails');

        Route::get('/allSupplierInvoice/{pickerBoy_id}',[NewOrderController::class,'allSupplierInvoice'])->name('allSupplierInvoice');



        // single product items for bar code route
        Route::get('/bppshopsbarcodeprint/{product_id}/{invoice_no}', [NewOrderController::class,'BppShopsProductBarCode'])->name('bppshopsbarcodeProductBarCode');
        // supplier barcode print
        Route::get('/generateProductBarCode/{product_id}/{invoice_no}', [NewOrderController::class,'SupplierProductBarCode'])->name('supplier_ProductBarCode');


       // main Order product items for bar code route
        Route::get('/generateOrderBarCode/{product_id}',[NewOrderController::class,'generateOrderBarCode'])->name('generateOrderBarCode');
        Route::get('/backToPickedOrderProcessList/',[NewOrderController::class,'backToPickedOrderProcessList'])->name('backToPickedOrderProcessList');
        Route::post('/processDone',[NewOrderController::class,'processDone'])->name('processDone');


        // customer invoice
           Route::get('/customerall/invoice/print/{order}', [NewOrderController::class, 'CustomerInvoicePrintBpp'])->name('customer_invoice');


    });

    // ========================== New Order Panel End ===============================================

    Route::get('/subscribe/view', [AdminUserController::class, 'subscribeView'])->name('subscribe.view');

});




// Multi language
Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');
Route::get('/language/hindi', [LanguageController::class, 'Hindi'])->name('hindi.language');

// all product detail route start
Route::get('/product/detail_fur/{cat_slug}/{subcat_slug}/{slug}', [IndexController::class, 'ProductFurDetails'])->name('ProductFurDetails');
Route::get('/product/detail/{cat_slug}/{subcat_slug}/{slug}', [IndexController::class, 'ProductDetails'])->name('ProductDetails_islamic');
Route::get('/product/detail/baby/{cat_slug}/{subcat_slug}/{slug}', [IndexController::class, 'ProductDetailsBaby'])->name('ProductDetailsBaby');
Route::get('/product/detail/fashion/{cat_slug}/{subcat_slug}/{slug}', [IndexController::class, 'ProductDetailsFashion'])->name('ProductDetailsFashion');
// all product detail route end

// for baby
Route::get('/product/view/modal/baby/{id}', [IndexController::class, 'BabyProductViewAjax']);
// for fashion
Route::get('/product/view/fashionmodal/{id}', [IndexController::class, 'FashionProductViewAjax']);
// Frontend tags page route
Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);
// Frontend SubCategory wise Data
Route::get('/subcategory/product/{subcat_id}', [IndexController::class, 'SubCatWiseProduct']);
// Frontend Sub  SubCategory wise Data
Route::get('/subsubcategory/product/{subsubcat_id}', [IndexController::class, 'SubSubCatWiseProduct']);
// Product view model ajax card
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

// Fur new route
Route::get('/productFu/view/modal/{id}', [IndexController::class, 'ProductViewFur']);

// Product Add to cart route ajax  use in package
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// Product mini Cart ajax data
Route::get('/product/mini/cart/', [CartController::class, 'AddMiniCart']);

// Remove mini cart product
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

// Add to Wishlist product
Route::get('/add-to-wishlist/{product_id}', [CartController::class, 'AddToWishlist']);

######### Start Product wishlist only view Auth user in use middleware ###########
Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function () {

    // Product Wishlist page
    Route::get('/wishlist', [WishlistController::class, 'ViewWishlist'])->name('wishlist');

    // Product Wishlist show data
    Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']);

    // Remove  Wishlist Product
    Route::get('/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishlistProduct']);

    // for paytmet gatway route
    // Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');


    // cash on delivery
    Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');

    // My orders page
    Route::get('/my/orders', [AllUserController::class, 'MyOrders'])->name('my.orders');


    // user order_details
    Route::get('/order_details/{order_id}', [AllUserController::class, 'OrderDetails']);

    // PDF invoices download
    Route::get('/invoice_download/{order_id}', [AllUserController::class, 'InvoiceDownload']);

    // Order Return Route
    Route::post('/return/order/{order_id}', [AllUserController::class, 'ReturnOrder'])->name('return.order');

    // order return list
    Route::get('/return/order/list', [AllUserController::class, 'ReturnOrderList'])->name('return.order.list');
    // order cancel
    Route::get('/cancel/orders', [AllUserController::class, 'CancelOrders'])->name('cancel.orders');


    // /// Order Traking Route
    // Route::get('/order/tracking', [AllUserController::class, 'OrderTraking'])->name('order.tracking');

    Route::post('/order/tracking', [AllUserController::class, 'OrderTraking'])->name('order.tracking');
    // user order_cancelorder
    Route::get('/cancelorder/{id}', [AllUserController::class, 'CancelOrder']);
});
####### End Product wishlist only view Auth user in use middleware  #############
// My cart page view
Route::get('/user/mycart', [PageCartController::class, 'MyCart'])->name('mycart');

// My Cart show data
Route::get('/user/get-cart-product', [PageCartController::class, 'GetCartProduct']);

// Remove  Wishlist Product
Route::get('/user/cart-remove/{rowId}', [PageCartController::class, 'RemoveCartProduct']);

// product increment botton route
Route::get('/cart-increment/{rowId}', [PageCartController::class, 'CartIncrement']);

// product Decrement botton route
Route::get('/cart-decrement/{rowId}', [PageCartController::class, 'CartDecrement']);


// Frontend Coupon  apply
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);

// Frontend Coupon Calculation
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);

// Coupon Remove
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

//################# start Checkout Route //####################
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
Route::get('/checkout/info', [CartController::class, 'CheckoutInfo'])->name('checkout.info');
Route::get('/checkout/info/all', [CartController::class, 'CheckoutInfoAll'])->name('checkout.info.all');
Route::get('/checkout/info/select/check/{id}', [CartController::class, 'CheckoutInfoSelect']);
Route::post('/checkout/info/delete', [CartController::class, 'CheckoutInfoDelete'])->name('checkout.info.delete');
Route::post('/checkout/process', [CartController::class, 'CheckoutProcess'])->name('checkout.process');
// Check out store route
Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.storeorder');

//change payment route
Route::get('/changepayment/option/{order_id}', [CheckoutController::class, 'ChangePayment'])->name('change.payment');


//################ End Checkout Route //####################

//################ Division District and state auto select Route //################
// district
Route::get('/district/ajax/{division_id}', [CheckoutController::class, 'DistrictGetAjax']);
// State
Route::get('/state/ajax/{district_id}', [CheckoutController::class, 'StateGetAjax']);
//#################  End Division District and state auto select Route  //#############
/// Product Search Route
Route::get('product/search', [IndexController::class, 'ProductSearch'])->name('product.search');
Route::get('product/searchColor/{color}', [IndexController::class, 'searchByColor'])->name('product.searchColor');
Route::get('product/searchCategory/{category}', [IndexController::class, 'searchByCategory'])->name('product.searchCategory');
Route::get('product/Category/{category}', [IndexController::class, 'categoryByProduct'])->name('product.categoryProduct');
Route::get('product/searchSubSubCategory/{category}', [IndexController::class, 'searchBySubSubCategory'])->name('product.searchSubSubCategory');
Route::get('product/latestProduct', [IndexController::class, 'latestProduct'])->name('product.latestProduct');
Route::get('product/popularProduct', [IndexController::class, 'GroceryPopularProduct'])->name('product.populartProduct');
Route::get('product/islamicpopularProduct', [IndexController::class, 'IslamicPopularProduct'])->name('islamicproduct.populartProduct');
Route::get('product/dalyProduct', [IndexController::class, 'GroceryDalyPopularProduct'])->name('product.dalytProduct');
Route::get('product/fashion/dalyProduct', [IndexController::class, 'FashionDalyPopularProduct'])->name('fashionproduct.dalytProduct');
Route::get('product/fashion/BestProduct', [IndexController::class, 'FashionBestPopularProduct'])->name('fashionproduct.BestProduct');
Route::get('product/dalyProductislamic', [IndexController::class, 'IslamicDalyPopularProduct'])->name('product.islamicdalytProduct');
Route::get('product/latestProduct', [IndexController::class, 'GroceryLatestPopularProduct'])->name('product.latestProduct');
Route::get('product/AllProduct', [IndexController::class, 'allProduct'])->name('product.allProduct');
Route::get('product/baby/featur/Product', [IndexController::class, 'BabyFeaturProduct'])->name('babyfeturproduct.Product');
Route::get('product/baby/best/seling/Product', [IndexController::class, 'BabyBestsSellingProduct'])->name('babybestproduct.Product');
Route::get('product/baby/top/seling/Product', [IndexController::class, 'BabyTopSellingProduct'])->name('babytopproduct.Product');
Route::get('product/baby/best/deal/Product', [IndexController::class, 'BabyTopBestDealProduct'])->name('babydealproduct.Product');

Route::get('product/fashion/category/Product', [IndexController::class, 'AllFashionCategoryProduct'])->name('fashionproduct.allProduct');
Route::get('product/cosmetic/category/Product', [IndexController::class, 'AllCosmeticCategoryProduct'])->name('Casmeticproduct.allProduct');

Route::get('product/fashion/brand/AllProduct', [IndexController::class, 'AllFashionBrandProduct'])->name('product.allProduct');
Route::get('porduct/fashion/brand/{id}',[FashionController::class,'brandWiseProduct'])->name('fashion.product.brandWiseProduct');
Route::get('porduct/fashion/category',[FashionController::class,'CategoryWiseProduct'])->name('fashion.product.categoryWiseProduct');
Route::get('electronic/all/category',[ElectronicController::class,'AllCategoryElectronic'])->name('electronic.all.category');

Route::get('product/PopularProduct', [IndexController::class, 'popularProduct'])->name('product.popularProduct');
Route::get('product/SpecialOfferProduct', [IndexController::class, 'specialOffer'])->name('product.specialOffer');
Route::get('product/SpecialDealProduct', [IndexController::class, 'specialDeal'])->name('product.specialDeal');
Route::get('cosmetic/category/page', [IndexController::class, 'CosmeticCategoryPage'])->name('cosmetic_category.page');

// Shop Page Route
Route::get('/shop', [ShopController::class, 'ShopPage'])->name('shop.page');

//Facebook Login
Route::get('login/google', [SocialiteLoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [SocialiteLoginController::class, 'handleGoogleCallback']);

//Facebook Login
Route::get('login/facebook', [SocialiteLoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [SocialiteLoginController::class, 'handleFacebookCallback']);
// google login
Route::get('login/google', [SocialiteLoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [SocialiteLoginController::class, 'handleGoogleCallback']);

// Twitter Login
Route::get('login/twitter', [App\Http\Controllers\Auth\LoginController::class, 'redirectToTwitter'])->name('login.twitter');
Route::get('login/twitter/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleTwitterCallback']);

//Review route start
Route::post('/product/review/{id}', [IndexController::class, 'review'])->name('product.review');
//Review Search end

//subscribe route start
Route::post('/subscribe', [IndexController::class, 'subscribe'])->name('subscribe');

//subscribe route end

//contact US
Route::get('/contact-us', function () {
    return view('frontend.contact.contact_us');
})->name('contact');

Route::post('/contact-us/send', [IndexController::class, 'contactUs'])->name('contactUs.send');

//contact Us End
// Admin All Department Route Group
Route::get('/getSubCategory/{id}', [IndexController::class, 'getSubCategoryForSidebar']);
Route::get('/getSubSubCategory/{id}', [IndexController::class, 'getSubSubCategoryForSidebar']);
Route::get('/SubSubCategory/{id}', [IndexController::class, 'getSubSubSubCategoryForSidebar']);

Route::get('/clearSession', function () {
    session()->flash('carts', 'Task was successful!');
    return 'clear';
});



// for pos using database
Route::post('search/product/filter', [AdminCartController::class, 'filterProduct']);
Route::post('add/carts/product/{product}', [AdminCartController::class, 'AddToCart']);
Route::post('add/carts/product/filter/{category}', [AdminCartController::class, 'filterCategory']);
Route::post('add/carts/brand/filter/{brand}', [AdminCartController::class, 'filterBrand']);
Route::get('get/carts/product', [AdminCartController::class, 'GetCart']);
Route::get('remove/carts/product/{id}', [AdminCartController::class, 'RemoveCart']);
Route::get('increment/carts/product/{id}', [AdminCartController::class, 'IncrementProductCart']);
Route::get('decrement/carts/product/{id}', [AdminCartController::class, 'DecrementProductCart']);
Route::get('clear/carts/product', [AdminCartController::class, 'ClearProductCart']);
Route::post('add/order/product/confirm', [AdminCartController::class, 'OrderConfirm']);
Route::get('add/order/posview', [AdminCartController::class, 'orderrecipt']);
Route::post('add/new/customer', [AdminCartController::class, 'AddCustomer'])->name('add.new.customer');
Route::post('hold/order/product', [AdminCartController::class, 'HoldOrder']);
Route::get('get/hold/order/product', [AdminCartController::class, 'GetHoldOrder']);
Route::get('get/hold/order/product/item/{id}', [AdminCartController::class, 'GetHoldOrderItem']);
Route::get('show/hold/order/product/{id}', [AdminCartController::class, 'ShowHoldOrderItem']);

// All charts Route start
// for DoughnutChartOne
Route::get('/get/donut', [AdminController::class, 'DoughnutChartOne']);

//for BarChart
Route::get('/get/bar', [AdminController::class, 'barChart']);

// for morris donut chart
Route::get('/get/morris', [AdminController::class, 'morrisChart']);

//for pie chart
Route::get('/get/pie', [AdminController::class, 'pieChart']);
// Tax
Route::prefix('tax')->group(function () {
    Route::get('/view', [TaxController::class, 'TaxAdd'])->name('tax.view');
});


Route::get('/get/productSortislamic/{sub_category_id}', [IndexController::class, 'GetProductsSortIslamic']);

Route::get('/get/productSortislamic/fashion/{sub_category_id}', [FashionController::class, 'FashionfarukGetProductsSortIslamic']);



Route::get('/get/subproductSort/{sub_category_id}', [IndexController::class, 'GetProductsSort2']);
Route::get('/get/subproductSort/fashion/sub/{sub_category_id}', [FashionController::class, 'FshionSubGetProductsSort2']);


Route::get('/get/subproductSort/grocery/{sub_category_id}', [IndexController::class, 'GrocerygetGetProductsSort2']);
Route::get('/get/productSortislamic/getproduct/{sub_category_id}', [IslamicController::class, 'FarukIslamicGetProductsSortIslamic']);

Route::post('/post/filteredProduct/', [IndexController::class, 'GetFilteredProducts']);
Route::post('/post/filteredProduct/fashion/', [FashionController::class, 'FashionGetGetFilteredProducts']);

Route::post('/post/filteredProduct/getproduct/', [IndexController::class, 'ProductGetFilteredProducts']);

Route::post('/post/filteredProductgetpage/', [IndexController::class, 'GetFilteredProductsGetpage']);
Route::post('/post/filteredProductgetpage/fashion/faruk/', [FashionController::class, 'FashionfarukGetFilteredProductsGetpage']);
Route::post('/post/filteredProductgetpage/islamicgetproduct/', [IslamicController::class, 'IslamicGetproductGetFilteredProductsGetpage']);


Route::post('/post/filteredProduct2/islamic/', [IslamicController::class, 'IslamicGetFilteredProducts2']);
Route::post('/post/filteredProduct2/grocery/', [GroceryController::class, 'GroceryGetFilteredProducts2']);
Route::post('/post/filteredProduct2/fashion/', [FashionController::class, 'FashionGetFilteredProducts2']);

Route::get('/IslamicController', [IndexController::class, 'LatestDiscountedProducts'])->name('latestdiscountedproducts.view');
Route::get('/latestdiscountedproductsgrocery', [GroceryController::class, 'GroceryLatestDiscountedProducts'])->name('latestdiscountedproducts.view');
Route::get('/grocery/latest/discount/products', [GroceryController::class, 'Grocery_LDP'])->name('grocery_ldp.view');

Route::get('/all_category', [IndexController::class, 'test'])->name('all_category.view');

Route::get('/getSubCategory/{id}', [IndexController::class, 'getSubCategoryForSidebar'])->name('get.subcat');
Route::get('/getSubSubCategory/{id}', [IndexController::class, 'getSubSubCategoryForSidebar'])->name('get.subsubcat');
Route::get('/SubSubCategory/{id}', [IndexController::class, 'getSubSubSubCategoryForSidebar']);


// ===================================== Offer Start All Route  List ===========================================
// Islamic  Special Offer
Route::get('/special/offer', [IslamicController::class, 'Offer'])->name('specialoffer.view');
// electronic  Special Offer
Route::get('/special/electronic/offer', [ElectronicController::class, 'ElectronicOffer'])->name('electronicspecialoffer.view');
// Grocery Special Offer
Route::get('/special/grocery/offer', [IndexController::class, 'GroceryOffer'])->name('grocery_specialoffer.view');
// Fashion Special Offer
Route::get('/special/fashion/offer', [FashionController::class, 'FashionOffer'])->name('fashion_specialoffer.view');
// furniture Special Offer
Route::get('/special/furniture/offer', [FurnitureController::class, 'FurnitureOffer'])->name('furniture_specialoffer.view');
// furniture Special Offer
Route::get('/product/furniture/more', [FurnitureController::class, 'FurnitureProductMore'])->name('furniture_product_more.view');
// baby Special Offer
Route::get('/special/baby/offer', [BabyController::class, 'BabyOffer_last'])->name('baby_specialoffer.view');

// baby Special Offer
Route::get('/special/cosmetics/offer', [CosmeticController::class, 'CosmeticsOffer_last'])->name('cosmetics_specialoffer.view');
Route::get('/special/cosmetics/popular/product', [CosmeticController::class, 'CosmeticsPopularProduct'])->name('cosmetics_popular_product.view');
Route::get('/special/cosmetics/feature/product', [CosmeticController::class, 'CosmeticsFeatureProduct'])->name('cosmetics_feature_product.view');





// Islamic Available Coupon offer
Route::get('/coupon/offer', [IndexController::class, 'Coupon'])->name('coupon.view');

// ===================================== Offer End All Route  List ===========================================


// filtering category
Route::get('get_causes_against_category/{id}', [IndexController::class, 'get_causes_against_category']);
// filtering sub category
Route::get('get_causes_against_subcategory/{id}', [IndexController::class, 'get_causes_against_subcategory']);
// filtering sub sub category
Route::get('get_causes_against_subsubcategory/{id}', [IndexController::class, 'get_causes_against_subsubcategory']);
// filtering category sort
Route::get('get_causes_against_categorysort', [IndexController::class, 'get_causes_against_categorysort']);
// filtering category sort
Route::get('get_causes_against_subcategorysort/{id}', [IndexController::class, 'get_causes_against_subcategorysort']);
Route::get('get_causes_against_subsubcategorysort/{id}', [IndexController::class, 'get_causes_against_subsubcategorysort']);
Route::get('/404', [IndexController::class, 'ErrorPage'])->name('get.error');
// --------- Frontend Footer Information route start ------------//
// Privacy & Policy route
Route::get('/privacy' , [InformationController::class,'privacy'])->name('info.privacy');
Route::get('/about' , [InformationController::class,'aboutPage'])->name('info.aboutPage');
Route::get('/terms-condition' , [InformationController::class,'termsCondition'])->name('info.terms');
Route::get('/returnpolicy' , [InformationController::class,'returnPolicy'])->name('info.policy');
// --------- Frontend Footer Information route  end ------------//


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/sendMessage',[UserController::class,'sendSms']);
Route::get('/supplier/all', [IndexController::class, 'SupplierDataShowAll']);
Route::get('/product/ajax/suggest/search', [IndexController::class, 'searchProductByAjax'])->name('searchproduct.ajax');
Route::get('/search', [IndexController::class, 'searchByProductNameView'])->name('searchproduct.view');

// Sidebar Search Route Start
Route::prefix('bs')->group(function () {
Route::get('/category_view', [IndexController::class, 'CategoryView'])->name('category.view');
Route::get('/grocerycategory_view', [GroceryController::class, 'GroceryCategoryView'])->name('grocerycategory.view');
Route::get('/{cat_slug}', [IndexController::class, 'SubCategoryView'])->name('subcategory.view');
Route::get('/{cat_slug}/{subcat_slug}', [GroceryController::class, 'SubSubCategoryView12'])->name('subsubcategory.view');
Route::get('/{cat_slug}/{subcat_slug}/{subsubcat_slug}', [IndexController::class, 'GetProductView1'])->name('getproduct.view');
    });

    // Sidebar Search Route Start
Route::prefix('gbs')->group(function () {
    Route::get('/grocery_category_view', [IndexController::class, 'GroceryCategoryView'])->name('grocery_category_view.view');
    Route::get('/{cat_slug}', [GroceryController::class, 'GrocerySubCategoryView'])->name('subcategory.view');
    Route::get('/{cat_slug}/{subcat_slug}', [GroceryController::class, 'GrocerySubSubCategoryView12'])->name('subsubcategory.view');
    Route::get('/{cat_slug}/{subcat_slug}/{subsubcat_slug}', [GroceryController::class, 'GroceryGetProductView1'])->name('getproduct.view');
        });
// Sidebar Search Route End
// ==========================================for cosmetic================================================
    Route::prefix('cbs')->group(function () {
        Route::get('/grocerycategory_view', [CosmeticController::class, 'CosmetictCategoryView'])->name('grocerycategory.view');
        Route::get('/{cat_slug}', [CosmeticController::class, 'CosmetictSubCategoryView'])->name('subcategory.view');
        Route::get('/{cat_slug}/{subcat_slug}', [CosmeticController::class, 'CosmetictSubSubCategoryView12'])->name('subsubcategory.view');
        Route::get('/{cat_slug}/{subcat_slug}/{subsubcat_slug}', [CosmeticController::class, 'CosmetictGetProductView1'])->name('getproduct.view');
            });
    // Sidebar Search Route End
// Sidebar Search Route Start
Route::prefix('fbs')->group(function () {
    Route::get('/grocerycategory_view', [FurnitureController::class, 'FurCategoryView'])->name('furniture_category.view');
    Route::get('/{cat_slug}', [FurnitureController::class, 'FurSubCategoryView'])->name('subcategory.view');
    Route::get('/{cat_slug}/{subcat_slug}', [FurnitureController::class, 'FurSubSubCategoryView12'])->name('subsubcategory.view');
    Route::get('/{cat_slug}/{subcat_slug}/{subsubcat_slug}', [FurnitureController::class, 'FurGetProductView1'])->name('getproduct.view');
        });
// Sidebar Search Route End
// Fashion Sidebar Search Route Start
Route::prefix('fabs')->group(function () {
    Route::get('/grocerycategory_view', [FurnitureController::class, 'FashCategoryView'])->name('fashion_category.view');
    Route::get('/{cat_slug}', [FashionController::class, 'FashSubCategoryView'])->name('subcategory.view');
    Route::get('/{cat_slug}/{subcat_slug}', [FashionController::class, 'FashSubSubCategoryView12'])->name('subsubcategory.view');
    Route::get('/{cat_slug}/{subcat_slug}/{subsubcat_slug}', [FashionController::class, 'FashGetProductView1'])->name('getproduct.view');
        });
// Sidebar Search Route End
// Sidebar Search Route Start
Route::prefix('bbs')->group(function () {
    Route::get('/babycategory_view', [BabyController::class, 'BCategoryView'])->name('babycategory.view');
    Route::get('/{cat_slug}', [IndexController::class, 'BSubCategoryView'])->name('baby_subcategory.view');
    Route::get('/{cat_slug}/{subcat_slug}', [BabyController::class, 'BSubSubCategoryView12'])->name('baby_subsubcategory.view');
    Route::get('/{cat_slug}/{subcat_slug}/{subsubcat_slug}', [BabyController::class, 'BGetProductView1'])->name('baby_getproduct.view');
        });
// Sidebar Search Route End
// Sidebar Search Route Start
Route::prefix('ebs')->group(function () {
    Route::get('/grocerycategory_view', [ElectronicController::class, 'ECategoryView'])->name('grocerycategory.view');
    Route::get('/{cat_slug}', [IndexController::class, 'ESubCategoryView'])->name('subcategory.view');
    Route::get('/{cat_slug}/{subcat_slug}', [ElectronicController::class, 'ESubSubCategoryView12'])->name('subsubcategory.view');
    Route::get('/{cat_slug}/{subcat_slug}/{subsubcat_slug}', [ElectronicController::class, 'EGetProductView1'])->name('getproduct.view');
        });
// Sidebar Search Route End
// ==================================> Grocery All Route Group Start<===========================
Route::get('/grocery', [GroceryController::class, 'landing'])->name('grocery.index');
// ==================================> Grocery All Route Group End<=============================
// ==================================> Fashion All Route Group Start<===========================
Route::get('/fashion', [FashionController::class, 'landing'])->name('fashion.index');
Route::get('/fashions/brands',[FashionController::class,'brands'])->name('fashion.brands');
Route::get('/fashions/{cat_slug}/{sub_cat_slug}',[FashionController::class,'subcategoryProducts'])->name('fashion.subCategory.product');
Route::get('/fashions/specialOffer',[FashionController::class,'specialOffer'])->name('fashion.specialOffer');

// ==================================> Fashion All Route Group End<=============================
// ==================================> cosmetic All Route Group Start<===========================
Route::get('/cosmetic', [CosmeticController::class, 'landing'])->name('cosmetic.index');

Route::get('/cosmetic/product/detail/{cat_slug}/{subcat_slug}/{slug}', [CosmeticController::class, 'CosmatictProductView'])->name('cosmeticproduct_view.index');
Route::get('/cosmetic-brandwise-product/{id}', [CosmeticController::class, 'CosmatictBrandWiseProductView'])->name('cosmeticbrandwiseproduct_view');
Route::get('/cosmetic-all-brand', [CosmeticController::class, 'CosmatictBrand'])->name('cosmeticbrand_view');
// ==================================> cosmetic All Route Group End<=============================
// Frontend Route
 // Route::get('/', [HomeController::class, 'landing'])->name('user.index');
// Islamic Website
Route::get('/islamic', [IslamicController::class, 'landing'])->name('islamic');
// ==================================> electronic All Route Group Start<===========================
Route::get('/electronic', [ElectronicController::class, 'landing'])->name('electronic.index');
Route::get('/electronic/product/detail/{cat_slug}/{subcat_slug}/{slug}', [IndexController::class, 'electronicProductDetails'])->name('electronicProductDetails');

// ==================================> baby All Route Group Start<===========================
Route::get('/baby', [BabyController::class, 'landing'])->name('baby.index');
// ==================================> baby All Route Group End<=============================
// ==================================> furniture All Route Group Start<===========================
Route::get('/furniture', [FurnitureController::class, 'landing'])->name('furniture.index');
// ==================================> cosmetic All Route Group End<=============================
  Route::any('foo', function () {
    //
    return view('index');
});

Route::get('/imageResize', [ImageController::class, 'imageResize']);

// for search backend products
Route::get('admin/product/search/ajax/{adminId}/{value}',[ProductController::class,'searchProductWithAjax']);
Route::get('admin/product/search/ajax/{userId}/{value}',[ProductController::class,'searchProductWithAjax']);

// Route::get('/allpospro',[PosAgentController::class,'loadOnScrollProduct']);

// search preoducd for agent panel
Route::get('admin/product/search/agent-search/{value}',[AgentPanelController::class,'searchProductWithAjax']);

// for brand search
Route::get('admin/brand/search/ajax/{adminId}/{value}',[BrandController::class,'searchBrandByAjax']);
// for category search
Route::get('admin/category/search/ajax/{adminId}/{value}',[CategoryController::class,'searchCategoryByAjax']);
// for sub category search
Route::get('admin/subcategory/search/ajax/{adminId}/{value}',[SubCategoryController::class,'searchSubcategoryByAjax']);
//for sub sub category search
Route::get('admin/subsubcategory/search/ajax/{adminId}/{value}',[SubSubCategoryController::class,'searchSubsubcategoryByAjax']);

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);

Route::post('/easyPayment',[SslCommerzPaymentController::class, 'easyPaymentView'])->name('checkout.easypayment');
//SSLCOMMERZ END


