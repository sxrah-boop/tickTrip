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
    
                // For regular users, allow them to proceed without redirection
                return $next($request);
            }
    
            // If the user is not authenticated, allow them to proceed
            return $next($request);
        }
    }