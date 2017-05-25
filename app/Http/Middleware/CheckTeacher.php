<?php

namespace App\Http\Middleware;

use Closure;

class CheckTeacher
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
        $teacherType = 1;
        if(Auth::user()->user_type === $teacherType){
            return $next($request);
        }

        return redirect()->route("homepage");
    }
}
