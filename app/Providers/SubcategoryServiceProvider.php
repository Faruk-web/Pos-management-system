<?php

namespace App\Providers;

use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use App\Providers\ProductServiceProvider as ProoductProvider;
use App\Providers\CategoryServiceProvider as CategoryProvider;

class SubcategoryServiceProvider extends ServiceProvider

{
    /**
     * Register services.
     *
     * @return void
     */
    // ================================================Islamic for api==========================
    public static function getTopRatedForIslamic($cat)
    {
        $SubCategory = SubCategory::with('category')
            ->where('ecom_id', '1')
            ->where('category_id', $cat->id)
            ->select(['id', 'sub_category_name', 'subcategory_image'])
            ->get();
        return $SubCategory;
    }

    public static function getApiSidebarSubCategoryViewForIslamic()
    {
        $subcategory = SubCategory::where('ecom_id', '1')
            ->select('id', 'category_id', 'sub_category_slug_name')
            ->get();
        return $subcategory;
    }


    public static function getApiSubCategoryViewForIslamic($cat_id)
    {
        $cat = CategoryProvider::ifExist($cat_id);
        $getcategory = SubcategoryServiceProvider::getTopRatedForIslamic($cat);
        return $getcategory;
    }
    public static function getApiSubSubCategoryView12ForIslamic($cat_id,$subcat_id)
    {

        $productUnderSubCategory=ProoductProvider::getAPIproductUnderSubCategory($cat_id,$subcat_id);
        $getsubsubcategory = SubSubCategory::where('ecom_id','1')->where('subcategory_id', $subcat_id)->where('category_id', $cat_id)->get(['id','subsubcategory_name','subsubcategory_image']);
        return [$productUnderSubCategory,$getsubsubcategory];
    }
  // ================================================ End Islamic for api==========================
   // ================================================Start Grocery for api==========================
   public static function getApiSubCategoryViewForGrocery($cat_id)
   {
        $getsubcategory1 = DB::table('sub_categories')
        ->where('ecom_id','2')
        ->where('category_id',$cat_id)
        ->select(['id','sub_category_name','subcategory_image'])
        ->get();
       return $getsubcategory1;
   }
   public static function getApisidebar_subcategory_2ForGrocery()
   {
    $subcategory = SubCategory::where('ecom_id','2')
    ->select('id','category_id','sub_category_slug_name')
    ->get();
       return $subcategory;
   }
    // ================================================End Grocery for api==========================
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
