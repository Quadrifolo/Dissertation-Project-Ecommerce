<?php

namespace App\Http\Middleware;

use Closure;
use App;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
// Checks to see if the session already has a locale set 
        if (\Session::has('locale')) {
            // locale is then set as the sessions locale and the applications locale 
            $locale = \Session::get('locale', \Config::get('app.locale'));
        } else {
            // if the session has no locale the http header is then used 
            $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE='), 0, 2);

            if ($locale != 'jp' && $locale != 'en' && $locale != 'ng') {
                $locale = 'en';
            }
        }

        App::setLocale($request->locale);


        return $next($request);
    }

}
