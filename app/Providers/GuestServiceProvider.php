<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GuestServiceProvider extends ServiceProvider
{
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
        //// Laravel policies only work if the user isn't null so for guest access we need to assign a dummpy user.
    // From now on to check for guest use is_null(Auth::user()->getKey())
    if(!Auth::check()) {
        $userClass = config('auth.providers.users.model');
        Auth::setUser(new $userClass());
    }
    
}

}
