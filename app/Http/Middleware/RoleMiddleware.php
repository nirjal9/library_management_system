<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $roles)
    {
        // Convert roles from a string (e.g., 'admin|user') to an array
        $rolesArray = explode('|', $roles);

        // Check if the user's role matches any of the allowed roles
        if (!$request->user() || !in_array($request->user()->role, $rolesArray)) {
            return redirect('/unauthorized'); // Redirect to the unauthorized page
        }

        return $next($request);
    }
}
