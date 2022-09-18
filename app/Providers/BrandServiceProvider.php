<?php

namespace App\Providers;

use App\Models\Brand;
use Illuminate\Support\ServiceProvider;

class BrandServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function getApibrand2ForFashion()
    {
        $brands = Brand::where('ecom_id', '3')
        ->orderBy('id', 'DESC')
        ->get(['id','brand_name_cats_eye','brand_image']);
        return $brands;

    }
      //*************************Start For Web All  Ecom ************************

   //*************************Start For Only  Fashion ************************ */ 
   public static function getBrand($ecomName){
    $brands = Brand::where('ecom_id', $ecomName)
    ->orderBy('id', 'DESC')
    ->get();
    return $brands;
  }
//*************************Start For Web Only Fashion ************************ */ 
//*************************End For All  Ecom ************************

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
