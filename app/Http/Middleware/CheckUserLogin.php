<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class CheckUserLogin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return $next($request);
        }
        return redirect()->route('home');
    }
}
