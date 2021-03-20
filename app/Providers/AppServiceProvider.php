<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use Cookie;
use GeoIP;
use Request;
use Illuminate\Support\Facades\Schema;
use App\Providers\Route;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()



   
    {

        
        \Blade::directive('convert', function ($money) {
            return "<?php echo number_format($money, 2); ?>";
        });



        \Route::resourceVerbs([
            'shop-en' => 'ショップ',
            
    
    
    
    
        ]);
    




        //Check for 'lang' cookie
        $cookie = Cookie::get('lang');
        //Get visitors IP
        $ip = \Request::ip();
        //Get visitors Geo info based on his IP
       // $geo = GeoIP::getLocation($ip);
        //Get visitors country name
        //$country = $geo['country'];

        //Prepared language based on country name
        //Add as many as you want
     //   $languages = [
       //     'United Kingdom' => 'en',
         //   'Japan' => 'jp',
           // 'Nigeria' => 'ng',
       // ];

      //  if(!isset($cookie) && !empty($cookie)) {
            //If cookie exist change application language
            //We use this for good measure
            App::setLocale($cookie); 
     //   }else {
            //If cookie doesnt exist
            //Check country name in languages array
       //     if (array_key_exists($country, $languages)) {
                //Get country value(language) from array
         //       $lang = $languages[$country];
                //Set language based on value
           //     App::setLocale($lang); 

            //}
           // else {
                //Set language for good measure
           //     App::setLocale(App::getLocale()); 
           // }







/*
            $locale = \App::getLocale(); 

            if (\App::isLocale('jp')) {
   //
          Date::setlocale('ja');
            $dates=\Date::now()->format('Y F l j H:i:s'); 
                }


            view()->share('dates', $dates);

*/

$greetings ="";


/* This sets the $time variable to the current hour in the 24 hour clock format */
$time = date("H");

/* Set the $timezone variable to become the current timezone */
$timezone = date("e");

/* If the time is less than 1200 hours, show good morning */
if ($time < "12") {
    $greetings = "Good Morning";
} else

/* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
if ($time >= "12" && $time < "17") {
    $greetings = "Good Afternoon";
} else

/* Should the time be between or equal to 1700 and 1900 hours, show good evening */
if ($time >= "17" && $time < "19") {
    $greetings = "Good Evening";
} else

/* Finally, show good night if the time is greater than or equal to 1900 hours */
if ($time >= "19") {
    $greetings = "Good Night";
}





view()->share('greetings', $greetings);
            











//}
    








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
