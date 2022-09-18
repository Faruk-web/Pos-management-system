<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\review;
use App\Models\Product;
use App\Models\BannerCatagory;
use App\Models\SubSubCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use App\Http\Resources\Special_offerResource;
use App\Providers\reviewServiceProvider as ReviewProvider;
use App\Providers\MultiimgServiceProvider as MultiimgProvider;
class ProductServiceProvider extends ServiceProvider
{


      // ############################################# Start For API ###########################################################

    public static function getAPISpecialDeals(){
        // for  special_deals
                $special_deals = Product::
                where('special_deals', 1)
                ->where('ecom_name', '1')
                ->select(['id','ecom_name','product_thambnail','product_code','supplier_id',
                'brand_id','category_id','sub_category_id','product_name','product_slug_name',
                'product_qty','unit_price','purchase_price','selling_price','discount_price',
                'purchase_date','status','purchase_qty','product_tags',
                'refundable','product_descp','meta_title','meta_desc','shipping',
                'shipping_fee','cash_on_delivery','hot_deals','featured','special_offer',
                'special_deals','product_views','vat'])
                ->orderBy('id', 'DESC')
                ->get();

                return $special_deals;
            }



            public static function API_specialoffer()
            {
                return Special_offerResource::collection(Cache::remember('id', 60 , function (){
                    $special_deals = Product::where('ecom_name', '1')->orderBy('id', 'DESC')->get();
                   return $special_deals;
                }));
            }

            public static function special_offers(){

                $special_offers = Product::where('special_offer', 1)->where('ecom_name', '1')->select(['id','product_thambnail','product_name','product_qty','selling_price','discount_price','status','purchase_qty','product_size','product_color','product_descp','video_link','unit'])->orderBy('id', 'DESC')->get();


                return $special_offers;
            }

           //*************************Start For Islamic ************************ */

    public static function getAPISpecialoffer(){
                // for  special_offer
        $special_offers = Product::where('special_offer', 1)
                            ->where('ecom_name', '1')->whereHas('supplier',function($q)
                            {
                                $q->where('supplyer_status',1);
                            })
                            ->select(['id','product_thambnail','product_name','product_qty','selling_price',
                            'discount_price','status','purchase_qty','product_size','product_color','product_descp','video_link','unit'])
                            ->orderBy('id', 'DESC')->get();

                            return $special_offers;
                        }
    public static function getAPIHotdeals(){
        // for  special_offer
        $hot_deals = Product::where('hot_deals', 1)
        ->where('ecom_name', '1')
        ->where('discount_price', '!=', NULL)
        ->select(['id','ecom_name','product_thambnail','product_code','supplier_id','brand_id','category_id','sub_category_id','product_name','product_slug_name','product_qty','unit_price','old_purchase_price','purchase_price','selling_price','discount_price','purchase_date','status','purchase_qty','product_tags','refundable','product_descp','meta_title','meta_desc','shipping','shipping_fee','cash_on_delivery','hot_deals','featured','special_offer','special_deals','product_views','vat'])
        ->orderBy('id', 'DESC')
        ->get();
        return $hot_deals;
                }
    public static function getAPIProducts(){
        // for  special_offer
        $products = Product::where('status', 1)
        ->where('ecom_name', '1')
        ->select(['id','ecom_name','product_thambnail','product_code','supplier_id','brand_id','category_id','sub_category_id','product_name','product_slug_name','product_qty','unit_price','old_purchase_price','purchase_price','selling_price','discount_price','purchase_date','status','purchase_qty','product_tags','refundable','product_descp','meta_title','meta_desc','shipping','shipping_fee','cash_on_delivery','hot_deals','featured','special_offer','special_deals','product_views','vat'])
        ->orderBy('id', 'DESC')
        ->get();
        return $products;
      }
      public static function getAPImost_popular_all_Forislamic(){
        // for  special_offer
        $most_popular_all = Product::with(['multiImg'=>function($query)
      {
         $query->select('photo_name','product_id');
      }])->where('status', 1)
      ->where('ecom_name', '1')
      ->get(['id','product_thambnail','product_name','selling_price','discount_price','unit','product_qty','product_descp'
      ,'product_size','product_color','video_link']);
        return $most_popular_all;
      }
      public static function getAPIRecently_addedislamic(){
        // for  special_offer
        $latest_products = DB::table('products')
      ->join('reviews','reviews.id','=', 'reviews.product_id')
      ->where('ecom_name','1')
      ->orderBy('product_id','Desc')
      ->select('product_id','product_name','product_thambnail','selling_price','discount_price','product_size','product_color','product_descp','quality','price','value')
      ->get();

        return $latest_products;
      }
      public static function getAPISubSubProduct($sub_category_id,$category_id){
        // for  special_offer
        $productUnderSubCategory= Product::where('ecom_name','1')
        ->where('sub_category_id', $sub_category_id)
        ->where('category_id',$category_id)
        ->get(['id','product_thambnail','product_name','product_qty','selling_price',
        'discount_price','video_link','product_descp','unit','product_color','product_size']);
        return $productUnderSubCategory;
      }
      public static function getAPIGetProductView1($cat_id,$subcat_id){
        // for  special_offer
        $productUnderSubCategory = Product::where('ecom_name','1')->where('sub_category_id',$subcat_id)->where('category_id',$cat_id)->where('sub_sub_category_id', null)->get(['id','product_thambnail','product_name','purchase_qty','selling_price','discount_price','video_link','product_descp','unit','product_color','product_size']);
        return $productUnderSubCategory;
      }
      public static function getAPIproductUnderSubCategory($subsubcat_id){
        // for  special_offer
        $getproduct = Product::where('sub_sub_category_id', $subsubcat_id)->first(['product_thambnail','product_name','selling_price','discount_price','product_qty','purchase_qty','product_descp','unit','product_color','product_size']);
        return $getproduct;
      }
      public static function getAPIrelated_product($cat_id,$id){
        // for  special_offer

        $product = Product::where('id',$id)->first();
        $cat_id = $product->category_id;
        $recomndedProduct=Product::where('ecom_name','1')
        ->where('category_id',$cat_id)
        ->where('id', '!=', $product->id)
        ->orderBy('id', 'DESC')
        ->get(['id','product_thambnail','product_name','selling_price','discount_price']);
        return $recomndedProduct;
      }
      public static function getAPIProductDetails($slug){
        // for  special_offer

        $product = Product::where('product_slug_name', $slug)->first();
        //  $product = Product::where('id', $id);
        Product::find($product->id)->increment('product_views');
        $product_color = $product->product_color;
        $product_color_all = explode(',', $product_color);
        $product_size = $product->product_size;
        $product_size_all = explode(',', $product_size);
        // for related product show
        $cat_id = $product->category_id;
        $reviews = review::where('product_id', $product->id)->with('user')->orderBy('id', 'DESC')->get();
        return[
            $product,
            $product_color_all,
            $product_size_all,
            $reviews

        ];
      }
      public static function getAPICategorySubcategory($p,$q){
        // for  special_offer

        $product = DB::table('products')
                    ->join('multi_imgs', 'multi_imgs.id', '=', 'products.id')
                    ->where('ecom_name','1')
                    ->where('sub_category_id',$p)
                    ->where('sub_sub_category_id',$q)
                    ->select('product_id','product_name','product_thambnail','selling_price','discount_price','unit','product_qty','photo_name')
                    ->get();
        return $product;
      }
      public static function getAPISubcategory($p){
        // for  special_offer

        $product = DB::table('products')
                    ->join('multi_imgs', 'multi_imgs.id', '=', 'products.id')
                    ->where('ecom_name','1')
                    ->where('sub_category_id',$p)
                    ->select('product_id','product_name','product_thambnail','selling_price','discount_price','unit','product_qty','photo_name')
                    ->get();
        return $product;
      }
      public static function getAPISubSubcategory($q){
        // for  special_offer
        $product = DB::table('products')
                    ->join('multi_imgs', 'multi_imgs.id', '=', 'products.id')
                    ->where('ecom_name','1')
                    ->where('sub_category_id',$q)
                    ->select('product_id','product_name','product_thambnail','selling_price','discount_price','unit','product_qty','photo_name')
                    ->get();
        return $product;
      }

    //   ===============================================start for grocery api==========================================================

    public static function getAPImost_popular_all_For_Grocery(){
        // for  special_offer
        $most_popular_all = Product::with(['multiImg'=>function($query)
      {
         $query->select('photo_name','product_id');
      }])->where('status', 1)
      ->where('ecom_name', '2')
      ->get(['id','product_thambnail','product_name','selling_price','discount_price','unit','product_qty','product_descp'
      ,'product_size','product_color','video_link']);
        return $most_popular_all;
      }
      public static function getAPIhot_deals_2_For_Grocery(){
        // for  special_offer
        $hot_deals = Product::with(['multiImg'=>function($query)
      {
         $query->select('photo_name','product_id');
      }])->where('hot_deals', 1)
      ->where('ecom_name', '2')
      ->where('discount_price', '!=', NULL
      )->select('id','product_thambnail','product_name','selling_price','discount_price','start_date','end_date')->orderBy('id', 'DESC')->limit(6)->get();
        return $hot_deals;
      }
      public static function getAPIrecently_added_2_For_Grocery(){
        // for  special_offer
        $latest_products = DB::table('products')
        ->where('ecom_name','2')
         ->select(['id','product_thambnail','product_name','selling_price','discount_price'])
         ->get();
        return $latest_products;
      }
      public static function getAPIspecial_offers_2_For_Grocery(){
        // for  special_offer
        $special_offers = DB::table('products')
        ->where('ecom_name','2')
        ->select('id','product_thambnail','product_name','selling_price','discount_price','unit','product_descp')
        ->get();
        return $special_offers;
      }
      public static function getAPIrelated_product_2_For_Grocery($cat_id,$id){
        // for  special_offer
        $recomndedProduct = DB::table('products')
            ->where('ecom_name','2')
            ->where('category_id',$cat_id)
            ->where('id', '!=', $id)

            ->orderBy('id','desc')
            ->get(['id','product_thambnail','product_name','selling_price','discount_price']);
        return $recomndedProduct;
      }
      public static function getAPIgrocery_ProductView_For_Grocery($a){
        // for  special_offer
        $product = new Product();

        if($a->category_id)
        {
            $product=Product::where('ecom_name','2')->where('category_id',$a->category_id)->get(['id','product_name','product_thambnail','selling_price','discount_price','unit','product_qty']);



        }
        else if($a->sub_category_id)
        {
            $product=Product::where('ecom_name','2')->where('sub_category_id',$a->sub_category_id)->get(['id','product_name','product_thambnail','selling_price','discount_price','unit','product_qty']);
            // dd($product);
        }
        else
        {
             $product=Product::where('ecom_name','2')->where('sub_sub_category_id',$a->sub_sub_category_id)->get(['id','product_name','product_thambnail','selling_price','discount_price','unit','product_qty']);
        }
        return $product;
      }
      public static function getAPIProductViewAjax_For_Grocery($id){
        // for  special_offe
        $product = Product::with('category', 'subcategory', 'subsubcategory')->findOrFail($id);
        $review = ReviewProvider::getApiOnlyReviewForGrocery($id);
        $users = ReviewProvider::getApiUserReviewForGrocery($id);
        $multiimgs =  MultiimgProvider::getApiMultiimgForGrocery($id);
        $color = $product->product_color;
        $product_colors = explode(',', $color);
        $size = $product->product_size;
        $product_sizes = explode(',', $size);
        $reviews = ReviewProvider::getApiUserReviewsForGrocery($id);

        return response([
          'product' => $product,
          'review' => $review,
          'color' => $product_colors,
          'size' => $product_sizes,
          'users' => $users,
          'multiimgs' => $multiimgs,
          'reviews' => $reviews
        ]);
      }
      public static function getAPIGetFilteredProducts2_For_Grocery($a){
        // for  special_offer
        $a->validate([
            'sub_category_id' => 'required',
            'minPrice' => 'required',
            'maxPrice' => 'required'
        ]);

        $querys = Product::where('sub_category_id', $a->sub_category_id)

            ->where(function ($query) use ($a) {
                $query->where(function ($subquery) use ($a) {
                    $subquery->whereBetween('selling_price', [$a->minPrice, $a->maxPrice])
                        ->where('discount_price', '=', 0);
                })
                    ->orWhere(function ($subquery) use ($a) {
                        $subquery->whereBetween('discount_price', [$a->minPrice, $a->maxPrice])
                            ->where('discount_price', '!=', 0);
                    });
            })
            ->get(['id','product_thambnail','product_name','selling_price',
            'discount_price','product_qty','product_stock_alert','unit','product_color',
            'product_size','product_descp','video_link']);
        return $querys;
      }
// =============================================================End for grocery api=========================================================
// =============================================================start for Fashion api=========================================================
        public static function getAPIhot_deals_2_For_Fashion(){
            // for  special_offer
            $hot_deals = Product::with(['multiImg'=>function($query)
        {
            $query->select('photo_name','product_id');
        }])->where('hot_deals', 1)
        ->where('ecom_name', '3')
        ->where('discount_price', '!=', NULL
        )->select('id','product_thambnail','product_name','selling_price','discount_price','start_date','end_date')->orderBy('id', 'DESC')->limit(6)->get();
            return $hot_deals;
        }
        public static function getAPIlatestproduct_For_Fashion(){
            // for  special_offer
            $latest_products = Product::orderBy('id', 'DESC')
            ->where('ecom_name', '3')
            ->limit(10)
            ->get(['id','product_name','product_thambnail','selling_price','discount_price','unit','product_descp','product_size','product_color']);
            return $latest_products;
        }
        public static function getAPItop_rated_For_Fashion(){
            // for  special_offer
            $top_rated = Product::select('id','product_name','product_thambnail','selling_price','discount_price')->has('review')
            ->withSum('review','quality')
            ->where('ecom_name', '3')
            ->orderBy('review_sum_quality','desc')->limit(10)
            ->get();
            return $top_rated;
        }
        public static function getAPIpopular_product_For_Fashion(){
            // for  special_offer
            $most_popular_all = Product::with(['multiImg'=>function($query)
        {
            $query->select('photo_name','product_id');
        }])->where('status', 1)
        ->where('ecom_name', '3')
       ->select('id','product_thambnail','product_name','selling_price','discount_price','start_date','end_date')->orderBy('id', 'DESC')->limit(6)->get();
            return $most_popular_all;
        }
        public static function getAPIfashion_products_For_Fashion(){
            // for  special_offer
            $products =DB::table('products')
            ->select('id','product_thambnail','product_name','selling_price','discount_price','unit','product_descp','product_size','product_color')
            ->where('status', 1)
            ->where('ecom_name', '3')
            ->orderBy('id', 'DESC')->limit(8)->get();
            return $products;
        }
        public static function getAPIspecial_offer_For_Fashion(){
            // for  special_offer
            $special_offers = Product::where('special_offer', 1)
            ->where('ecom_name', '3')
            ->orderBy('id', 'DESC')
            ->limit(6)
            ->get(['id','product_thambnail','product_name','selling_price','start_date','end_date','product_expire_date']);
            return $special_offers;
        }
        public static function getAPIfashion_special_deals_For_Fashion(){
            // for  special_offer
            $special_deals = Product::where('special_deals','1')
            ->where('ecom_name', '3')
            ->orderBy('id', 'DESC')
            ->limit(6)
            ->get(['id','product_thambnail','product_name','selling_price','start_date','end_date','product_expire_date']);
            return $special_deals;
        }
        public static function getAPIfashion_hot_deals_For_Fashion(){
            // for  special_offer
            $hot_deals = Product::with(['multiImg'=>function($q)
            {
              $q->select('photo_name','product_id');
            }])->where('ecom_name', '3')->where('discount_price', '!=', NULL)->orderBy('id', 'DESC')->get(['id','product_name','start_date','end_date','product_expire_date','selling_price','discount_price']);

            return $hot_deals;
        }
        public static function getAPIfashion_featureds_For_Fashion(){
            // for  special_offer
            $featureds = Product::where('featured', 1)->where('ecom_name', '3')->orderBy('id', 'DESC')->limit(6)->get();

            return $featureds;
        }
        public static function getAPIfashion_newTwoproducts_For_Fashion(){
            // for  special_offer
            $newTwoproducts = Product::where('status', 1)
            ->where('ecom_name', '3')
            ->orderBy('id', 'DESC')
            ->limit(2)
            ->get();

            return $newTwoproducts;
        }
        public static function getAPIfashion_Latestdiscountproduct_For_Fashion(){
            // for  special_offer
            $latestdiscountproduct = Product::whereNotNull('discount_price')
            ->where('ecom_name', '3')
            ->orderBy('id', 'DESC')
            ->limit(2)
            ->get();

            return $latestdiscountproduct;
        }
// =============================================================End for Fashion api=========================================================





           // ############################################# Start For Web ###########################################################
           //*************************Start For All Ecom  ************************ */
            public static function getSpecialDeals($ecomName){


                $special_deals = Product::where('status',1)
                    ->where('special_deals', 1)
                    ->where('ecom_name',$ecomName)
                    ->whereHas('supplier', 
                                function($q) {
                                  $q->where('supplyer_status',1);
                                })
                    ->orderBy('id', 'DESC')->limit(6)->get();

                return $special_deals;
              }

              public static function gethotDeals($ecomName){

                $hot_deals = Product::where('status',1)->where('hot_deals', 1)
                ->where('ecom_name', $ecomName)->where('discount_price', '!=', NULL)
                ->whereHas('supplier',function($q){$q->where('supplyer_status',1);})
                ->orderBy('id', 'DESC')->limit(6)->get();

                return $hot_deals;
              }

              public static function getFeatureds($ecomName){

                $featureds = Product::where('status',1)
                ->where('featured', 1)->where('ecom_name', $ecomName)
                ->whereHas('supplier',function($q){$q->where('supplyer_status',1);})
                ->orderBy('id', 'DESC')->limit(6)->get();
                return $featureds;
              }

              public static function getProducts($ecomName){

                $products = Product::where('status', 1)
                ->where('ecom_name', $ecomName)
                ->whereHas('supplier',function($q){ $q->where('supplyer_status',1);})->orderBy('id', 'DESC')->limit(8)->get();
                return $products;

              }

              public static function getNewTwoproducts($ecomName){

                $newTwoproducts = Product::where('status', 1)
                   ->where('ecom_name', $ecomName)
                   ->whereHas('supplier',function($q){$q->where('supplyer_status',1);})->orderBy('id', 'DESC')->limit(2)->get();
                return $newTwoproducts;
              }
              public static function getSpecialOffers($ecomName){

                $special_offers = Product::where('status',1)
                ->where('special_offer', 1)
                ->where('ecom_name', $ecomName)
                ->whereHas('supplier',function($q){ $q->where('supplyer_status',1);})->orderBy('id', 'DESC')->limit(6)->get();

                return $special_offers;
              }




              public static function getMostPopular($ecomName){
                $most_popular_all = Product::where('status',1)
                ->where('status', 1)
                ->whereHas('supplier',function($q){$q->where('supplyer_status',1);})->where('ecom_name',$ecomName)->limit(7)->get();
                return $most_popular_all;
              }



              public static function getDailyBestSales($ecomName){
                 $dailyBestSales =  DB::table('order_items')
                 ->join('products', 'products.id', '=', 'order_items.product_id')
                 ->where('status',1)->where('products.ecom_name',$ecomName)
                 ->select('product_id', DB::raw('count(*) as total'), 'products.*')
                 ->groupBy('product_id')
                 ->orderBy('total', 'DESC')
                 ->limit(7)->get();
                return $dailyBestSales;
              }


              public static function getTopRatedProduc($ecomName){
                $top_rated = DB::table('reviews')
                ->select('products.*', 'brands.brand_name_cats_eye')
               ->join('products', 'product_id', 'products.id')
               ->join('brands', 'products.brand_id', 'brands.id')
               ->where('status',1)
               ->where('products.ecom_name',$ecomName)
               ->distinct('product_id')
               ->where('star', '>', 3)
               ->limit(8)
               ->get();
                return $top_rated;
              }



              public static function getLatestProducts($ecomName){
                $latest_products = Product::orderBy('id', 'DESC')
                 ->where('status',1)
                 ->whereHas('supplier',function($q){$q->where('supplyer_status',1);})->where('ecom_name', $ecomName)->limit(3)->get();

                return $latest_products;
              }
              public static function getLatestDiscountProduct($ecomName){
                $latestdiscountproduct = Product::where('discount_price','!=','0')
                  ->where('status',1)
                  ->where('ecom_name', $ecomName)
                  ->paginate(12);
                return $latestdiscountproduct;
              }



              public static function getTrendingProducts($ecomName){
                $trendingProducts = DB::table('order_items')
                 ->join('products', 'products.id', '=', 'order_items.product_id')
                 ->select('*', 'product_id', DB::raw('count(*) as total'))
                 ->where('status', 1)
                 ->where('products.ecom_name',$ecomName)
                 ->groupBy('product_id')
                 ->orderBy('total', 'DESC')
                 ->limit(3)
                 ->get();
                return $trendingProducts;
              }



//*************************Start Only For Fashion ************************ */

public static function getTrendingProductsForFashion($ecomName){
  $trendingProducts = DB::table('order_items')
  ->join('products', 'products.id', '=', 'order_items.product_id')
  ->select('*', 'product_id','product_thambnail', 'unit', 'selling_price', 'discount_price', 'product_name', 'product_slug_name', DB::raw('count(*) as total'))
  ->where('products.ecom_name',$ecomName)
  ->groupBy('product_id')
  ->where('status',1)
  ->orderBy('total', 'DESC')
  ->limit(3)
  ->get();
  return $trendingProducts;
}
public static function getdailyBestSalesnewForFashion($ecomName){
  $dailyBestSales_new =  DB::table('order_items')
->join('products', 'products.id', '=', 'order_items.product_id')->where('products.ecom_name',$ecomName)->select('product_id',  DB::raw('count(*) as total'), 'products.*')
->groupBy('product_id')->orderBy('total', 'DESC')
->limit(12)
->get();
  return $dailyBestSales_new;
}


//*************************End Only For Fashion ************************ */
//*************************Start Only For Electronic ************************ */

public static function getlastMonthBestSales(){
  $lastMonthBestSales = DB::table('products')
  ->leftJoin('order_items','products.id','=','order_items.product_id')
  ->whereMonth('order_items.created_at',Carbon::now()->submonth(1))
  ->selectRaw('products.*, sum(order_items.qty) total_sales')
  ->groupBy('products.id')
  ->orderBy('total_sales','desc')
  ->take(15)
  ->get();
  return $lastMonthBestSales;
}
public static function getTopSales($ecomName){
  $topSales = Product::leftJoin('order_items','products.id','=','order_items.product_id')
  ->selectRaw('products.*, COALESCE(sum(order_items.qty),0) total_sales')->groupBy('products.id')
  ->with('category','subcategory')
  ->where('products.ecom_name',$ecomName)
  ->whereHas('supplier',function($q)
  {
      $q->where('supplyer_status',1);})
      ->orderBy('total_sales','desc')
      ->take(10)
      ->get();

  return $topSales;
}

//*************************End Only For Electronic ************************ */


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
