<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HodMiddleware
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
        if (!auth()->user()->hasRole('HOD')) {
            abort(403, 'This is only accessible to Head of Department');
        }

        return $next($request);
    }
}