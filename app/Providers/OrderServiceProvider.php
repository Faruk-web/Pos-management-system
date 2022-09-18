<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Carbon;



class OrderServiceProvider extends ServiceProvider
{
     //*************************Start For Fashion Api ************************ */
     public static function getApiBest_Selling_ProductsForFashion(){
        $onsale = Order::select('products.*', 'brands.brand_name_cats_eye')
        ->where('orders.created_at', '>', Carbon::now()
        ->subHours(12)
        ->toDateTimeString())
        ->where('orders.status', '=', 'delivered')
        ->join('order_items', 'order_items.order_id', '=', 'orders.id')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->join('brands', 'brands.id', '=', 'products.brand_id')->where('products.ecom_name','1')->limit(8)->get();
       return $onsale;
     }
      //*************************End For Fashion ************************ */


     //*************************Start For All Web  Ecom ************************ */

     public static function getOnsale($ecomName){
        $onsale = Order::select('products.*', 'brands.brand_name_cats_eye')
        ->where('orders.created_at', '>', Carbon::now()
        ->subHours(12)
        ->toDateTimeString())
        ->where('orders.status', '=', 'delivered')
        ->join('order_items', 'order_items.order_id', '=', 'orders.id')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->join('brands', 'brands.id', '=', 'products.brand_id')->where('products.ecom_name',$ecomName)->limit(8)->get();
       return $onsale;
       
     }


 //*************************Start opnly For Fashion ************************ */ 
   

 public static function fashionBestSellingNew($ecomName){
  $fashion_best_selling_new = Order::select('products.*', 'brands.brand_name_cats_eye')
  ->where('orders.status', '=', 'delivered')
  ->join('order_items', 'order_items.order_id', '=', 'orders.id')
  ->join('products', 'products.id', '=', 'order_items.product_id')
  ->join('brands', 'brands.id', '=', 'products.brand_id')
  ->where('ecom_id',$ecomName)
   ->limit(16)
   ->get();
   return $fashion_best_selling_new;
 }  

 public static function dailyBestSellProductForFashion($ecomName){
  $daily_best_sell_product = Order::where('orders.created_at', '>', Carbon::now()->subHours(12)->toDateTimeString())
  ->where('orders.status', '=', 'delivered')
  ->join('order_items', 'order_items.order_id', '=', 'orders.id')
  ->join('products', 'products.id', '=', 'order_items.product_id')
  ->join('reviews', 'products.id', '=', 'reviews.product_id')
  ->select('order_items.product_id','products.*',DB::raw('sum(reviews.quality) as sum_star'),DB::raw('count(reviews.id) as total_star'))
  ->groupBy('product_id')    
  ->where('products.ecom_name', $ecomName)->limit(10)
  ->get();
   return $daily_best_sell_product;
 }  

 //************************* End Only For  Fashion ************************ */


//*************************End For All Ecom ************************ */

 

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
