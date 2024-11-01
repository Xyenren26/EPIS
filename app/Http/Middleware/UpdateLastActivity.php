<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\AccountTable;

class UpdateLastActivity
{
    public function handle($request, Closure $next)
    {

        if (session()->has('user_id')) {
            $userId = session('user_id');
            $lastActivity = session('last_activity');
            $lifetime = config('session.lifetime'); // Lifetime in minutes

            // Retrieve the user using the user ID stored in the session
            $user = AccountTable::find($userId); // Use find instead of where

            if ($user) {

                // Update last_activity in the database
                $user->last_activity = now(); // Update last_activity
                $user->save(); // Save changes to the database

                // Update last_activity in the session
                session(['last_activity' => now()]);
            }
        }
        if ($lastActivity && now()->diffInMinutes($lastActivity) >= $lifetime) {
            $user->session_id = null; 
            $user->last_activity = null;
            $user->save();
            
            return redirect('login')->withErrors([
                'login' => 'Your session has expired due to inactivity.',
            ]);
        }
        return $next($request);
    }
}
