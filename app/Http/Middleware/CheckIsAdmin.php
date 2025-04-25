<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    if (!$user->isAdmin()) {
        session()->flash('warning', 'Jums nav administratora tiesības!');
        return redirect()->route('index');
    }

    return $next($request);
}

}
