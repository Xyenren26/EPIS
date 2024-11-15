<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfTechnicalAdministrator
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is logged in and if the user is a technical-administrator
        if (Auth::check() && Auth::user()->AccountType === 'technical-administrator') {
            return $next($request);  // Allow access to the next request
        }

        // Redirect to a different page if the user is not a technical-administrator
        return redirect('/home')->with('error', 'Access denied: You do not have permission to view this page.');
    }
}

