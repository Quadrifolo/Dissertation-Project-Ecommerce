<?php

//namespace App\Http\Middleware;

//use Closure;

class GeoIP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next ,$guard = null)
    {

    // check if already detect current session country
    if (!session('country')) {
        $location = geoip();
        session([
            'country' => $location->country,
            'currency' => $location->currency
        ]);
    }

      
    }
}
