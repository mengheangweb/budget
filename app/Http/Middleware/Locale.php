<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = session()->get('lang');
// dd($locale);
        App::setLocale($locale);

        return $next($request);
    }
}
