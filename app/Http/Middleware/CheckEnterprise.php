<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckEnterprise
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
        $enterpriseType = 3;
        if(Auth::user()->user_type == $enterpriseType){
            return $next($request);
        }

        return redirect()->route("homepage");
    }
}
