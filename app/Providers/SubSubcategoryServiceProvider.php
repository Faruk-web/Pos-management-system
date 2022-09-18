<?php

namespace App\Providers;

use App\Models\SubSubCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class SubSubcategoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    // ======================================Star for islamic api===================================
    public static function getAPIsidebar_SubSubProductislamic(){
        // for  special_offer
         $subsubproducts = SubSubCategory::where('ecom_id','1')
         ->select('id','category_id','subcategory_id','subsubcategory_slug_name')
         ->get();
        // $productUnderSubCategory = Product::where('ecom_id','1')->get();

        return $subsubproducts;
      }
          // ======================================End for islamic api===================================
// ======================================Start for Grocery api===================================
public static function getAPISubSubCategroyGrocery($a){
    // for  special_offer
    $validator = Validator::make($a->all(),[
        'category_id' => 'required',
        'subcategory_id'=>'required'
        ]);
       if ($validator->fails()) {
        return response([
            'errors' => $validator->messages()
        ]);
    }else{

        $subsub_categories = new SubSubCategory();
        $subsub_categories->subcategory_id = $a->subcategory_id;
        $subsub_categories->category_id = $a->category_id;
        // dd($product->category_id);
        $getsubsubcategory = DB::table('sub_sub_categories')
                            ->where('category_id',$subsub_categories->category_id)
                            ->where('subcategory_id', $subsub_categories->subcategory_id)
                            ->select(['id','subsubcategory_name','subsubcategory_image'])
                            ->get();

    return $getsubsubcategory;
  }
}
public static function getAPIsidebar_SubSubCategroyGrocery(){
    // for  special_offer
    $subsubcategories = SubSubCategory::where('ecom_id','2')
    ->select('id','category_id','subcategory_id','subsubcategory_slug_name')
    ->get();
    return $subsubcategories;
  }

 // ======================================End for islamic api===================================
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
