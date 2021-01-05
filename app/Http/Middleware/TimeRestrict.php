<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class TimeRestrict
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
        $start = Carbon::parse('08:00:00');
        $end = Carbon::parse('17:00:00');

        if(now() < $start || now() > $end) {
         //   Auth::logout();
          //  return redirect('/login')->with('message','You are using in restrict period.');
        }

        return $next($request);
    }
}
