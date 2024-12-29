<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$role)
    {
        if (Auth::check() && Auth::user()->role === 'guru') {
            return $next($request);
        }

        return redirect(404)->with('error', 'Access denied');
    }
}