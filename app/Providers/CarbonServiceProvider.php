<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;

class CarbonServiceProvider extends ServiceProvider
{

    public static function getTodayDate(){
        $todayDate = Carbon::now();
        return $todayDate;
      }
      public static function getApiTodayDateForIslamic(){
        $todayDate = Carbon::now();
        return $todayDate;
      }
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
