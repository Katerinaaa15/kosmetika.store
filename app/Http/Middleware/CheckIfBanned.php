<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfBanned
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isBanned()) {
            Auth::logout();

            return redirect()->route('login')->withErrors([
                'email' => 'Jūsu konts ir bloķēts.',
            ]);
        }

        return $next($request);
    }
}
