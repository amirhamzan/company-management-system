<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // To check if the user is log in and with email admin GR Tech only
        if (auth()->check() && auth()->user()->email !== 'admin@grtech.com') {
            abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
