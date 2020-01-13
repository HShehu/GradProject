<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;

class SetLocale
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
        $selected = $request->segment(1);        
        $languages = config('app.available_locales');
        
        if (in_array($selected,$languages)) {
           app()->setLocale($selected);
        }

        return $next($request);
    }
}
