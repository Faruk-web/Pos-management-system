<?php

namespace App\Providers;

use App\Models\MultiImg;
use Illuminate\Support\ServiceProvider;

class MultiimgServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public static function getApiMultiimgForGrocery($id){
        $multiimgs =  MultiImg::where('product_id', $id)->limit(6)->get();
         return $multiimgs;
       }
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
