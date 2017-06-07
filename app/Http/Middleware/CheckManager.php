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
        if(Auth::user()->user_type == $managerType){
            return $next($request);
        }

        return redirect()->route("homepage");
    }
}
