<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;

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

use App\Http\Controllers\SupplierDashboardController;


// ashim controller add
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\EmployeeController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
// for frontend
use App\Http\Controllers\Frontend\IndexController;
// use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\ShopController;
use Illuminate\Support\Facades\Auth;
// for user
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\PageCartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\InformationController;
use App\Http\Controllers\Backend\AdminCartController;
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
use App\Http\Controllers\Backend\TaxController;
use App\Http\Controllers\Backend\ApiController;
use App\Http\Controllers\EmployeerController;
use App\Models\User;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth:sanctum']], function () {

    // User Update Profile
    Route::get('/user/profile/update', [ApiController::class, 'UserProfile']);
    // user profile store
    Route::post('/user/profile/store', [ApiController::class, 'UserProfileStore']);
    // user Change Password
    Route::get('/user/change/password', [ApiController::class, 'UserChnagePassword']);
    // user  Password Update
    Route::post('/user/password/update', [ApiController::class, 'UserPasswordUpdate']);
    //address
 // Check out store route
    Route::get('/checkout/info', [ApiController::class, 'CheckoutInfo'])->name('checkout.info');
    Route::get('/checkout/info/all', [ApiController::class, 'CheckoutInfoAll'])->name('checkout.info.all');
    Route::post('/checkout/info/delete', [ApiController::class, 'CheckoutInfoDelete'])->name('checkout.info.delete');
    Route::get('/checkout/info/select/check/{id}', [ApiController::class, 'CheckoutInfoSelect']);
    // Route::get('/checkout/info/select/check/{id}', [ApiController::class, 'CheckoutInfoSelect']);
    // Product Add to cart route ajax  use in package
    Route::post('/cart/data/store/{id}', [ApiController::class, 'AddToCart']);
    Route::post('/checkout/store', [ApiController::class, 'CheckoutStore'])->name('checkout.storeorder');
    Route::get('/checkout', [ApiController::class, 'CheckoutCreate'])->name('checkout');
    Route::post('/checkout/process', [ApiController::class, 'CheckoutProcess'])->name('checkout.process');
    //change payment route
    Route::get('/changepayment/option/{order_id}', [ApiController::class, 'ChangePayment'])->name('change.payment');
    // My orders page
    Route::get('user/my/orders', [ApiController::class, 'MyOrders'])->name('my.orders');
     // user order_details
     Route::get('user/order_details/{order_id}', [ApiController::class, 'OrderDetails']);
    // /// Order Traking Route
    Route::post('user/order/tracking', [ApiController::class, 'OrderTraking'])->name('order.tracking');
    Route::get('/cancelorder/{id}', [ApiController::class, 'CancelOrder']);
     //Review route start
    Route::post('/product/review/{id}', [ApiController::class, 'review'])->name('product.review');
    Route::get('/cancelorder/{id}', [ApiController::class, 'CancelOrder']);
    // Product view model ajax card

});
  Route::post('/previous_reviews', [ApiController::class, 'previous_reviews']);

//product details
Route::get('/product/detail/{cat_slug}/{subcat_slug}/{slug}', [ApiController::class, 'ProductDetails'])->name('ProductDetails');

//     ------------------------------------Brand----------------------------------------
Route::get('/{role}/brand_view', [BrandController::class, 'BrandnewViewApi']);
// ------------------------------------Category------------------------------------
Route::get('bs/category_view', [ApiController::class, 'CategoryView']);
// -----------------------------------Sub Category_view-----------------------------
Route::get('bs/{cat_id}', [ApiController::class, 'SubCategoryView']);
// ---------------------------------Sub Sub Category_view---------------------------
Route::get('subsubcategory/view', [SubSubCategoryController::class, 'SubSubCategoryViewApi']);


Route::post('login', [UserController::class, 'loginAPI']);
Route::post('login/Email', [UserController::class, 'loginWithEmail']);
Route::post('newregister', [UserController::class, 'registerapi']);
// -------------------------------Login With Otp API----------------------------------------
Route::post('loginWithOtp', [UserController::class, 'loginWithOtpApi']);
Route::post('sendOtp', [UserController::class, 'sendOtpApi']);

Route::post('login/google', [ApiController::class, '_registerOrLoginUser'])->name('login.google');
Route::post('login/google', [SocialiteLoginController::class, 'redirectToGoogleAPI'])->name('login.google');
Route::get('login/google/callback', [SocialiteLoginController::class, 'handleGoogleCallbackAPI']);

// ---------------------------Brand View---------------------------------------------------------




// -----------------------------------Product View-------------------------------------------
// Manage Product
Route::get('product/manage', [ApiController::class, 'ManageProduct']);
//  ------------------------------Sliders View------------------------------------------------
Route::get('slider/view', [ApiController::class, 'SliderView'])->name('manage.slider');
//----------------------------Bannner_view----------------------------------------------------
Route::get('banner/view', [ApiController::class, 'BennarView'])->name('bennar.manage');
//--------------------------------Banner_category_View--------------------------------------
Route::get('bannerCategory/view', [ApiController::class, 'Bennar_categoryView']);
//--------------------------------Coupon start-------------------------------------------------------------
Route::get('cupons/view', [ApiController::class, 'CouponView']);
//----------------------------------Special_Offer------------------------------------------------------------
Route::get('product/SpecialOfferProduct', [ApiController::class, 'specialOffer'])->name('product.specialOffer');

// district
Route::get('/district/ajax/{division_id}', [ApiController::class, 'DistrictGetAjax']);
// State
Route::get('/state/ajax/{district_id}', [ApiController::class, 'StateGetAjax']);
//#################  End Division District and state auto select Route  //#############


// Islamic Website---------------------------ISlamic-------------------------------------------------------------------------

Route::get('/banner1',[ApiController::class,'banner1']);

Route::get('/slider',[ApiController::class,'slider']);
Route::get('/special_deals',[ApiController::class,'special_deals']);
Route::get('/hot_deals',[ApiController::class,'hot_deals']);
Route::get('/special_offers',[ApiController::class,'special_offers']);
Route::get('/featureds',[ApiController::class,'featureds']);
Route::get('/products',[ApiController::class,'products']);
Route::get('/newTwoproducts',[ApiController::class,'newTwoproducts']);
Route::get('/categories',[ApiController::class,'categories']);
Route::get('/most_popular_all',[ApiController::class,'most_popular_all']);
Route::get('/dailyBestSales',[ApiController::class,'dailyBestSales']);
Route::get('/deliverdProducts',[ApiController::class,'deliverdProducts']);
Route::get('/top_rated',[ApiController::class,'top_rated']);
Route::get('/onsale',[ApiController::class,'onsale']);
Route::get('/recently_added',[ApiController::class,'recently_added']);
Route::get('/latestdiscountproduct',[ApiController::class,'latestdiscountproduct']);
Route::get('/toprated',[ApiController::class,'toprated']);
Route::get('/trendingProducts',[ApiController::class,'trendingProducts']);





//Islamic sub_category

Route::get('bs/category_view', [ApiController::class, 'CategoryView'])->name('category.view');
Route::get('sidebar_category_view', [ApiController::class, 'sidebar_CategoryView'])->name('category.view');
Route::get('bs/{cat_id}', [ApiController::class, 'SubCategoryView']);
Route::get('sidebar_subcategory', [ApiController::class, 'sidebar_subcategory']);
Route::get('bs/{cat_id}/{subcat_id}', [ApiController::class, 'SubSubCategoryView12']);
Route::get('sidebar_SubSubProduct',[ApiController::class,'sidebar_SubSubProduct']);
Route::post('bs/products', [ApiController::class, 'SubSubProduct']);
Route::post('/multiImg', [ApiController::class, 'multiimg']);
Route::get('bs/{cat_id}/{subcat_id}/{subsubcat_id}', [ApiController::class, 'GetProductView1']);
Route::get('/related_product/{cat_id}/{id}',[ApiController::class,'related_product']);
Route::post('/GetFilteredProducts',[ApiController::class,'GetFilteredProducts2']);
Route::post('/islamic_ProductView',[ApiController::class,'islamic_ProductView']);
//End Islamic
// ===============================================================================================================================================================================
// ===============================================================================================================================================================================
//Grocery_start/////
//Grocery_start/////
// ==================================> Grocery All Route Group Start<===========================
Route::get('/slider_2',[ApiController::class,'slider_2']);
Route::get('/dailyBestSales_2',[ApiController::class,'dailyBestSales_2']);
Route::get('/most_popular_all_2',[ApiController::class,'most_popular_all_2']);
Route::get('/banner1_2',[ApiController::class,'banner1_2']);
Route::get('/banner2_2',[ApiController::class,'banner2_2']);
Route::get('/top_selling_2',[ApiController::class,'top_selling_2']);
Route::get('/trending_product_2',[ApiController::class,'trending_product_2']);
Route::get('/top_rated_2',[ApiController::class,'top_rated_2']);
Route::get('/recently_added_2',[ApiController::class,'recently_added_2']);
Route::get('/special_offers_2',[ApiController::class,'special_offers_2']);
Route::get('/deal_of_day',[ApiController::class,'hot_deals_2']);
Route::get('/related_product_2/{cat_id}/{subcat_id}/{id}',[ApiController::class,'related_product_2']);
Route::get('/grocery', [ApiController::class, 'GroceryIndex'])->name('grocery.index');
Route::get('gs/CategoryView_2', [ApiController::class, 'CategoryView_2']);
Route::get('sidebar_CategoryView_2', [ApiController::class, 'sidebar_CategoryView_2']);
Route::get('gs/{cat_id}', [ApiController::class, 'SubCategoryView_2']);
Route::get('sidebar_subcategory_2', [ApiController::class, 'sidebar_subcategory_2']);
Route::post('gs/products', [ApiController::class, 'SubSubCategroy']);
Route::get('sidebar_SubSubCategroy', [ApiController::class, 'sidebar_SubSubCategroy']);
Route::post('gs/Product_show', [ApiController::class, 'grocery_ProductView']);
Route::post('gs/product',[ApiController::class,'Products']);
Route::get('gbs/{cat_slug}', [ApiController::class, 'GrocerySubCategoryView'])->name('subcategory.view');
Route::get('gbs/{cat_slug}/{subcat_slug}', [ApiController::class, 'SubSubCategoryView12'])->name('subsubcategory.view');
Route::get('gbs/{cat_id}/{subcat_id}/{subsubcat_id}', [ApiController::class, 'GroceryGetProductView1'])->name('getproduct.view');
// =======================================================================================================================================================================================
// ===============================================================fashion start===========================================================================================================
Route::get('fashion/brands',[ApiController::class,'brands']);
Route::get('fashion/banner',[ApiController::class,'banner']);
Route::get('fashion/slider',[ApiController::class,'slider1']);
Route::get('fashion/hotdeals',[ApiController::class,'hotdeals']);
Route::get('fashion/latestproduct',[ApiController::class,'latestproduct']);
Route::get('fashion/fashion_toprated',[ApiController::class,'fashiontoprated']);
Route::get('fashion/popular_product',[ApiController::class,'popular_product']);
Route::get('fashion/fashion_products',[ApiController::class,'fashion_products']);
Route::get('fashion/fashion_topCategoriesThisWeek',[ApiController::class,'fashion_topCategoriesThisWeek']);
Route::get('fashion/Best_Selling_Products',[ApiController::class,'Best_Selling_Products']);
Route::get('fashion/special_offer',[ApiController::class,'special_offer']);
Route::get('fashion/fashion_special_deals',[ApiController::class,'fashion_special_deals']);
Route::get('fashion/fashion_hot_deals',[ApiController::class,'fashion_hot_deals']);
