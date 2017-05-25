<?php

namespace App\Http\Middleware;

use Closure;

class CheckInstructor
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
        $instructorType = 2;
        if(Auth::user()->user_type == $instructorType){
            return $next($request);
        }

        return redirect()->route("homepage");
    }
}
