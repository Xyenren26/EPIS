<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClearExpiredSessions
{
    public function handle($request, Closure $next)
    {
        $userId = session('user_id');
        $sessionLastActivity = session()->get('last_activity');
        $sessionLifetime = config('session.lifetime');

        // Log the session data for debugging
        \Log::info("User ID: $userId");
        \Log::info("Last Activity: " . ($sessionLastActivity ? $sessionLastActivity : 'None'));
        \Log::info("Current Time: " . now());
        \Log::info("Session Lifetime: $sessionLifetime");

        // Check if the user is logged in and if the session has expired
        if ($userId && $sessionLastActivity && now()->diffInMinutes($sessionLastActivity) >= $sessionLifetime) {
            \Log::info("Session expired for user: $userId. Nullifying session_id.");
            // Expire the session and clear `session_id`
            DB::table('account_tables')->where('EmployeeID', $userId)->update(['session_id' => null]);

            Auth::logout(); // Log out the user
            session()->invalidate(); // Invalidate the session

            // Redirect to the login page
            return redirect()->route('login')->withErrors([
                'login' => 'Your session has expired due to inactivity.',
            ]);
        } else {
            // Update last activity timestamp
            session(['last_activity' => now()]);
        }

        return $next($request);
    }
}
