<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Banner;

class BannerServiceProvider extends ServiceProvider
{


         


        public static function getAPIbanner1(){
        $banner2 = Banner::where('status', 1)
        ->where('ecom_id','2')
        ->select(['bennar_img'])
        ->orderBy('id', 'DESC')->first();
        return $banner2;
        }
               //*************************End For IslamicAPI ************************ */

  //*************************Start For GroceryAPI ************************ */
        public static function getAPIbanner1Forgrocery(){
            $banner2 = Banner::where('status', 1)
            ->where('ecom_id','2')
            ->orderBy('id', 'DESC')->first();
            return $banner2;
        }
        public static function getAPIbanner2Forgrocery(){
            $banner2 = Banner::where('status', 1)
            ->where('ecom_id','2')
            ->orderBy('id', 'DESC')->first();
            return $banner2;
        }

        //*************************End For GroceryAPI ************************ */
         //*************************Start For FashionAPI ************************ */
         public function getApibanner2ForFashion()
         {
             $banner = Banner::where('status', 1)
             ->where('ecom_id', '3')
             ->orderBy('id', 'DESC')
             ->get(['bennar_img']);
             return $banner;

         }
         //*************************End For FashionAPI ************************ */


             //*************************Start For All Ecom ************************ */
        public static function getBanner2($ecomName){
          $banner2 = Banner::where('status', 1)
          ->where('ecom_id',$ecomName)
          ->orderBy('id', 'DESC')->first();
          return $banner2;
          }

          public static function getBanners($ecomName){
            $banners =  Banner::where('status', 1)
            ->where('ecom_id', $ecomName)
            ->latest()
            ->take(2)
            ->get();

            return $banners;
          }
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
