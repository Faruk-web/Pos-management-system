<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Slider;

class SliderServiceProvider extends ServiceProvider
{


         //*************************Start For Web  All Ecom ************************ */
         public static function getSliders($ecomName){
            $sliders = Slider::where('status', 1)
            ->where('ecom_id',$ecomName)
            ->orderBy('id', 'DESC')->limit(10)->get();
            return $sliders;
          }
          //*************************End For Web  All Ecom ************************ */
        //   ===============================================Star api for islamic======================================================
          public static function getAPISliderForIslamic(){
            $sliders = Slider::where('status', 1)
            ->where('ecom_id','1')
            ->orderBy('id', 'DESC')->limit(10)->get();
            return $sliders;
          }

     //   ===============================================End api for islamic======================================================
        // =================================================Start for grocery API==================================================================
        public static function getAPISliderForGrocery(){
            $sliders = Slider::where('status', 1)
            ->where('ecom_id','2')
            ->orderBy('id', 'DESC')->limit(10)->get();
            return $sliders;
          }
           //   ===============================================End api for grocery api======================================================
    //   ===============================================start api for fashion======================================================
    public static function getAPISliderForFashion(){
        $sliders = Slider::where('status', 1)
            ->where('ecom_id', '3')
            ->orderBy('id', 'DESC')
            ->limit(10)
            ->get((['slider_img']));
        return $sliders;
      }
        //   ===============================================End api for Fashion ======================================================

//    
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
