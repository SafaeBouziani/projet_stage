<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Import Auth facade from Illuminate\Support\Facades

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && Auth::user()->hasRole('admin'))
        {
            return $next($request);
        }
        else
        {
            Auth::logout();
            return redirect(url('login'));
        }
        
    }
}
