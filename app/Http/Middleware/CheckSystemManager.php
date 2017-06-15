<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckSystemManager
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
        $systemManagerType = 5;
        $adminType = 6;
        if(Auth::user()->user_type == $systemManagerType || \Auth::user()->user_type == $adminType){
            return $next($request);
        }

        return redirect()->route("homepage");
    }
}
