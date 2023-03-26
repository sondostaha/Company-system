<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetAppLang
{
  
    public function handle(Request $request, Closure $next)
    {
        //url = domain/ar
        $lang = Session::get('lang');
        if($lang)
        {
            App::setLocale($lang);
        }

        return $next($request);
    }
}
