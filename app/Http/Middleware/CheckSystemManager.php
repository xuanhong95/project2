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
        if(Auth::user()->user_type === $systemManagerType){
            return $next($request);
        }

        return redirect()->route("homepage");
    }
}
