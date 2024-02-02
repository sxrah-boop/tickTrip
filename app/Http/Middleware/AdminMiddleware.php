<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if ($request->user()) {
            // Check if the authenticated user is an admin
            if ($request->user()->isAdmin()) {
                return $next($request);
            }

            // Redirect users with the user role to the home route
            return redirect('/home')->with('error', 'Unauthorized access to the dashboard.');
        }

        // If the user is not authenticated, allow them to proceed
        return $next($request);
    }
}
