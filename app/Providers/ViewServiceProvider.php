<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use Cookie;
use GeoIP;
use Request;
use Illuminate\Support\Facades\Schema;
use Jenssegers\Date\Date;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()

   
    {
      


            $locale = \App::getLocale(); 

            if (\App::isLocale('jp')) {
   //
          Date::setlocale('ja');
            $dates=Date::now()->format('Y F l j H:i:s'); 
                
            }

            view()->share('dates', $dates);








            


        
    








        Schema::defaultStringLength(191);//
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
