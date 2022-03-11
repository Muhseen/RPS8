<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TFAMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('2FAPASSED')) {
            abort(403, '2 Factor Authentication Failed, Please Login again and enter the code sent to your Phone Number');
        }
        return $next($request);
    }
}