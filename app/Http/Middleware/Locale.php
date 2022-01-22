<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Locale{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $locale = $request->session()->get('locale');
        if(!isset($locale) || empty($locale)){
            App::setLocale(config('app.fallback_locale'));
        }else{
            App::setLocale($locale);
        }

        return $next($request);
    }
}
