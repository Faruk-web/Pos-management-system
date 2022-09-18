<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use App\Providers\SubcategoryServiceProvider as SubcategoryProvider;

class CategoryServiceProvider extends ServiceProvider
{



    //   ===========================for API PART==========================================
      public static function getApiCategoriesForIslamic(){
        $categories = Category::withCount('products')
        ->where('ecom_id', '1')
        ->select(['id','category_name','category_slug_name','category_image','category_icon'])
        ->get();
        return $categories;
      }
      public static function getApiCategoryViewForIslamic(){
        $getcategory = Category::where('ecom_id','1')
        ->select(['id','category_name','category_slug_name','category_image','category_icon'])
        ->get();
        return $getcategory;
      }
      public static function getApiSidebarCategoryViewForIslamic(){
        $getcategory = Category::where('ecom_id','1')
        ->select(['id','category_name','category_icon'])
        ->get();
        return $getcategory;
      }

      public static function ifExist($cat_id){

        $cat = Category::where('ecom_id','1')->where('id', $cat_id)->first();
        // $getsubcategory1 = SubCategory::where('category_id', $cat->id)->distinct('category_id')->get();

        return $cat ? $cat : false;

      }
//*************************End For Islamic API ************************ */

     //*************************Start For Grocery API************************ */
     public static function getApiCategoryViewForGrocery(){
        $getcategory = DB::table('categories')
        ->where('ecom_id','2')
        ->select(['id','category_name','category_image','category_icon'])
        ->get();

        return $getcategory;
    }
    public static function getApiSidebar_CategoryView_2ForGrocery(){
        $getcategory = Category::where('ecom_id','2')
        ->select(['id','category_name','category_icon'])
        ->get();

        return $getcategory;
    }
     //*************************End For Grocery API ************************ */

     //*************************Start For Fashion API************************ */
     public static function getApiFashion_topCategoriesThisWeek(){
        $topCategoriesThisWeek = Category::with('getSubCategoryLimitIs4')
        ->withCount('thisWeekOrdersProduct')
        ->where('ecom_id',3)
        ->orderBy('this_week_orders_product_count','desc')
        ->limit(4)
        ->get([]);

        return $topCategoriesThisWeek;
    }
    public static function getApiFashion_Category(){
        $categories = Category::with('fashionProduct')
        ->where('ecom_id', '3')
        ->get();

        return $categories;
    }

     //*************************End For Fashion API************************ */



    //*************************Start For All Ecom ************************ */
              public static function getCategories($ecomName){
                $categories = Category::withCount('products')
              
                ->where('ecom_id', $ecomName)->get();
                return $categories;
              }

                   
    //*************************Start Only For Fashion ************************ */
      
        public static function getTopCategoriesThisWeekForFashion($ecomName){
          $topCategoriesThisWeek = Category::with('getSubCategoryLimitIs4')
          ->withCount('thisWeekOrdersProduct')
          ->where('ecom_id',$ecomName)
          ->orderBy('this_week_orders_product_count','desc')
          ->limit(4)
          ->get();
            return $topCategoriesThisWeek;
          }
     //*************************End Only For Fashion ************************ */
    //*************************Start Only For Electronic ************************ */
      
    public static function getFirstCategory($ecomName){
      $firstCategory = Category::with(['electronicProduct'=>function($q){
        $q->with('review');
       },'subcategory'=>function($q){
        $q->with('electronicProducts');
        }])->where('ecom_id',$ecomName)->latest()->limit(3)->get();
        return $firstCategory;
      }

      public static function getCategoryWiseLastMonthBestSalesProduct(){
        $categoryWiseLastMonthBestSalesProduct = Category::has('electronicProduct')
        ->with(['electronicProduct'=>function($query)
      {
          $query->has('lastMonthBestSell')->withCount('lastMonthBestSell');
          $query->with('subcategory');
          
      }])->limit(5)->get()->sortBy('electronicProduct.lastMonthBestSell_count');

          return $categoryWiseLastMonthBestSalesProduct;
        }
     //*************************End Only For Electronic ************************ */


       //*************************End For  All Ecom ************************ */








      
        
   



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
