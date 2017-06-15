<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckManager
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
        $managerType = 4;
        $adminType = 6;
        if(Auth::user()->user_type == $managerType || \Auth::user()->user_type == $adminType){
            return $next($request);
        }

        return redirect()->route("homepage");
    }
}
