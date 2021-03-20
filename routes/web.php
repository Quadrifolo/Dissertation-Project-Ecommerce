<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/








// Global Domain Page For Site 



//Route::redirect('/home-en', '/en');

// Admin Route Page For Website All Admin Routes Are Accessed This Way
Route::group(['prefix' => 'admin'], function () {
  Voyager::routes();
});


// This Route Uses the Localization Middleware To Change The Locale of the Website 
//Route::get('locale/{locale}', function ($locale){
  //Session::put('locale', $locale);
  //return redirect()->back();
 //});

// Route::get(LaravelLocalization::transRoute('routes.about-en'), function () {

  //return view('about.index');

//}); 
  





//Route::redirect('/', '/en');

//Route::group(['prefix' => '{locale}'], function  () { 
 // Route::prefix('{lang}')->group(function() {

//Route::get('/', 'PagesController@Index')
  //->localization('jp')
  //->name('pages.index'); 

//  Route::post('login', 'Auth\LoginController@login');
  //Route::post('logout', 'Auth\LoginController@logout')->name('logout');
 // Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
 // Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('/about', 'PagesController@about')->name('about.index');

//  Route::group(
//    [
  ///    'prefix' => LaravelLocalization::setLocale(),
     // 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','localize' ]
    //], function(){ 
   


    Auth::routes();

  

  //Route::get('/global', 'PagesController@global')->name('global.index');
  Route::get('/' ,'PagesController@index')->name('pages.index');
  
  Route::get('lookbook' ,'PagesController@about')->name('lookbook.index');

  Route::get('shop' ,'ProductController@index')->name('shop.index');

  Route::get('product/{product}' ,'ProductController@show')->name('shop.product');

  Route::get('posts', 'PostsController@index')->name('posts.index');

  Route::get('posts/{posts}', 'PostsController@show')->name('posts.show');

  Route::get('cart', 'CartController@index')->name('cart.index');

 /// Route::get('/guestCheckout','');

  Route::get('cart/checkout', 'CartController@checkout')->name('cart.checkout');
  
  //Route::resource('posts', 'PostsController');

  //Route::get('product/{product}', 'ProductController@show')->name('shop.product');

Route::get('terms', 'PagesController@terms')->name('pages.terms');



Route::get('products/search', 'ProductController@search')->name('products.search');


Route::get('posts/search', 'PostsController@search')->name('posts.search');


  



//Get About Page Information



//Route::get('/about', 'PagesController@about')->name('about.index');




Route::get('/home', 'HomeController@index')->name('home');




Route::get('paypal/checkout/{order}', 'PayPalController@getExpressCheckout')->name('paypal.checkout');

Route::get('paypal/checkout-sucesss/{order}' ,'PayPalController@getExpressCheckoutSuccess')->name('paypal.success');
Route::get('paypal/checkout-cancel' ,'PayPalController@cancelPage')->name('paypal.cancel');

Route::get('/cart/destroy/item{itemid}', 'CartController@Destroy')->name('cart.destroy');
Route::get('/cart/update/item{itemid}', 'CartController@Update')->name('cart.update');

Route::get('/add-to-cart/{product}','CartController@Add')->name('cart.add');
 
Route::get('/language/{lang}','LanguageController@change')->name('lang');

Route::get('/cart/apply-coupon', 'CartController@applyCoupon')->name('cart.coupon');

Route::get('/cart/add-shipping', 'CartController@shipping')->name('cart.shipping');




//Route::get('/shop', 'ProductController@Index')->name('shop.index');


//Route::resource('ショップ', 'ProductController');
 

//Route::get('product/{product}', 'ProductController@show')->name('shop.product');



//Route::get('/cart', 'CartController@index')->name('cart.index')->middleware('auth');

//Route::get('/cart/checkout', 'CartController@checkout')->name('cart.checkout')->middleware('auth');

Route::resource('orders', 'OrderController');     //->middleware('auth');


Route::get('/tests','PagesController@test');


//Get Post Pages Information 


/*Route::get('details', function () {

	$ip = "45.77.57.221";
    $data = \Location::get($ip);
//   dd($data->countryCode);

    if ($data->countryCode = "GB"){

      redirect()->route('home-en');

    }
   
});
*/

//});