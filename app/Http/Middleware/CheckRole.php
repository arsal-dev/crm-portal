<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user has any of the specified roles
        if (!$request->user() || !$request->user()->role || !in_array($request->user()->role->name, $roles)) {
            abort(403); // Redirect to a 403 Forbidden page or handle it as per your application's needs
        }
    
        return $next($request);
    }
}
