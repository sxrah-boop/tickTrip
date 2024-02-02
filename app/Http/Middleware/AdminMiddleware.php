<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\UsersTableController;
use App\Http\Controllers\CustomAuth;

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
        }

        // If the user is not authenticated or not an admin, redirect them to the home page
        return redirect('/')->with('error', 'You do not have permission to access the dashboard.');
    }
}
