<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderItemServiceProvider extends ServiceProvider
{


      //*************************Start For All Ecom  ************************
      public static function getDeliverdProducts(){
        $deliverdProducts =  OrderItem::select('product_id')->groupBy('product_id')
         ->join('orders', 'order_items.order_id', '=', 'orders.id')
         ->join('products', 'products.id', '=', 'order_items.product_id')
        ->where('orders.status', 'delivered')
        ->get(['products.*']);
        return $deliverdProducts;
      }

      //*************************End For All  Ecom ************************
  


// ====================================Start for api islamic=======================================

      public static function getApiDailybestsalesForIslamic(){
        $dailyBestSales =  DB::table('order_items')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->where('products.ecom_name','1')
        ->select('product_id', DB::raw('count(*) as total') , 'product_id','products.product_descp','products.product_size','products.product_color','products.product_thambnail','products.product_name','products.product_slug_name','products.selling_price','products.unit','products.discount_price')
        ->groupBy('product_id')
        ->orderBy('total', 'DESC')
        ->get();
        return $dailyBestSales;
      }
      public static function getApitrendingProductsForIslamic(){
        $trendingProducts = DB::table('order_items')
            ->join('products', 'products.id', '=', 'order_items.product_id')->where('products.ecom_name','1')
            ->join('reviews','reviews.id','=', 'reviews.product_id')
             ->select( 'products.id','products.product_thambnail','products.product_name','products.product_size','products.product_color','products.product_descp','products.discount_price','products.selling_price','reviews.quality','reviews.price','reviews.value')
            ->groupBy('order_items.product_id')->get();;
        return $trendingProducts;
      }
// ===============================================================End for islamic api==================================================
// ====================================Start for api Grocery=======================================
public static function getApiDailybestsalesForGrocery(){
    $dailyBestSales =  DB::table('order_items')
    ->join('products', 'products.id', '=', 'order_items.product_id')
    ->where('ecom_name','2')
    ->select('product_id', DB::raw('count(*) as total'), 'product_id','product_name','product_descp','product_thambnail','selling_price','discount_price')
    ->groupBy('product_id')
    ->orderBy('total', 'DESC')
    ->limit(18)
    ->get();
    return $dailyBestSales;
  }
  public static function getApiTop_selling_2ForGrocery(){
    $popular_product =  DB::table('order_items')
    ->join('products', 'products.id', '=', 'order_items.product_id')->where('products.ecom_name','2')
     ->select('product_id', DB::raw('count(*) as total'), 'product_id','products.product_name','products.product_thambnail','products.selling_price','products.discount_price')
    ->groupBy('product_id')
    ->orderBy('total', 'DESC')
    ->limit(6)
    ->get();
    return $popular_product;
  }

// ====================================End for api Grocery=======================================
// ====================================Start for api Fashion=======================================
public static function getApiDailyBestSalesForFashion(){
    $dailyBestSales =  DB::table('order_items')
                    ->join('products', 'products.id', '=', 'order_items.product_id')
                    ->join('reviews', 'products.id', '=', 'reviews.product_id')
                    ->select('order_items.product_id','products.*',DB::raw('sum(reviews.quality) as sum_star'),DB::raw('count(reviews.id) as total_star'))
                    ->where('products.ecom_name', '3')
                    ->groupBy('product_id')
                    ->orderBy('total_star', 'DESC')
                    ->limit(16)
                    ->get();
    return $dailyBestSales;
  }
  public static function getApiDeliverdProductsForFashion(){
    $deliverdProducts =  OrderItem::select('product_id')->groupBy('product_id')
    ->join('orders', 'order_items.order_id', '=', 'orders.id')
    ->join('products', 'products.id', '=', 'order_items.product_id')
    ->where('products.ecom_name', '3')
    ->where('orders.status', 'delivered')
    ->get(['products.*']);
    return $deliverdProducts;
  }
  public static function getApitrendingProductsForFashion(){
    $trendingProducts =  OrderItem::select('product_id')->groupBy('product_id')
    ->join('orders', 'order_items.order_id', '=', 'orders.id')
    ->join('products', 'products.id', '=', 'order_items.product_id')
    ->where('products.ecom_name', '3')
    ->where('orders.status', 'delivered')
    ->get(['products.*']);
    return $trendingProducts;
  }

// ====================================End for api Fashion=======================================

/**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
