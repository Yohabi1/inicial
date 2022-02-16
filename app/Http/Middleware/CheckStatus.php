<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckStatus
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
        // dd(Auth::user());
        if (Auth::check())
        {
            if(Auth::user()->tfver == '0' && Auth()->user()->status == '1' && Auth()->user()->emailv == '0')
            {
                return $next($request);
            }
            else
            {
                return redirect('authorization');
            }
        }
        
    }
}
