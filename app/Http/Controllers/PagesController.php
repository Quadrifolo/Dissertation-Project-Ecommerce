<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Jenssegers\Date\Date;
use App\Holiday;
use Cmixin\BusinessDay;
use App\Lookbook;
use DB;

class PagesController extends Controller
{
    public function index(){
     



//BusinessDay::enable('Illuminate\Support\Carbon');

//\Carbon::setHolidaysRegion(\App::getLocale());

//foreach (\Carbon::getYearHolidays(2020) as $id => $holiday) {
    //echo $holiday->getHolidayName().': '.$holiday->format('l, F j, Y')."\n";
//}

//$locale = \App::getLocale(); 
/*
  if (\App::isLocale('ja')) {
   //
      Date::setlocale('ja');
 $dates=Date::now()->format('Y F l j H:i:s');   

  }if(\App::isLocale('en-GB')) {
    //
      Date::setlocale('en');
          
    $dates= Date::now()->format('l j F Y H:i:s');
    }else 
    
    if(\App::isLocale('yo')) {
    //
    }
  */ 
  
  Date::setlocale('en');
         
    $dates=Date::now()->format('l j F Y H:i:s');
    
    
    
//geoip($ip = '192.168.1.1');
   $homepage = DB::table('homepages')->where('locale', '=', 'EN')->get();
//dd($ip);1

     return view('pages.index', ['dates' => $dates , 'homepage' =>$homepage]);
//  return view('pages.index');
}





public function about (){

  
  $pictures = DB::table('lookbooks')->where('Locale', '=', 'EN')->get();

  

  
  




return view('pages.lookbook',['pictures' => $pictures]);
}



public function terms() { 


return view ('pages.terms');

}




/*
public function date(){
  
  $date="";

  
  $locale = \App::getLocale(); 

  if (\App::isLocale('jp')) {
   //
      Date::setlocale('ja');
 $date=Date::now()->format('Y F l j H:i:s');       
  }else  

if(\App::isLocale('en')) {
//
  Date::setlocale('en');
      
$date= Date::now()->format('l j F Y H:i:s');
}else 

if(\App::isLocale('ng')) {
//
Date::setlocale('en');
     
$date=Date::now()->format('l j F Y H:i:s');

}

dd($date);


return view('pages.index', compact('date'));
}

*/



/*public function about(){
 
  $holidays = Holiday::orderBy('created_at','desc')->paginate(0);



  //dd($holidays);

  return view('pages.about', ['holidays' => $holidays , ]);
}
*/






public function global(){

  return view('pages.global');
}


}
