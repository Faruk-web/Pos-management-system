<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\BannerCatagory;

class BannerCatagoryServiceProvider extends ServiceProvider
{




         //*************************Start For All Ecom ************************ */
         public static function getBanner1(){
            $banner1 = BannerCatagory::where('status', 1)
            ->orderBy('id', 'DESC')->first();
            return $banner1;
          }


     //*************************End For All Ecom ************************ */

    //*************************Start For Fashion API ************************ */
    public static function getApiFashion_BannerCategory(){
      $bannerCategroy = BannerCatagory::where('status', 1)
      ->where('ecom_id', '3')
      ->orderBy('id', 'DESC')
      ->limit(3)
      ->get();


      return $bannerCategroy;
  }

         //*************************End For Fashion API ************************ */

    //*

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
