<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateLastActivity
{
    public function handle($request, Closure $next)
    {
        \Log::info('UpdateLastActivity middleware called.');

        if (session()->has('user_id')) {
            $userId = session('user_id');
            $lastActivity = session('last_activity');
            $lifetime = config('session.lifetime'); // Lifetime in minutes

            // Update the last activity in the database as well
            DB::table('account_tables')->where('EmployeeID', $userId)->update(['last_activity' => now()]);

            if ($lastActivity && now()->diffInMinutes($lastActivity) >= $lifetime) {
                // If the session has expired, nullify session_id in `account_tables`
                DB::table('account_tables')
                    ->where('EmployeeID', $userId)
                    ->update(['session_id' => null]);

                // Log out the user and clear the session
                Auth::logout();
                session()->invalidate();

                // Redirect to the login page
                return redirect()->route('login')->withErrors([
                    'login' => 'Your session has expired due to inactivity.',
                ]);
            }

            // Update `last_activity` time in the session
            session(['last_activity' => now()]);
        }

        return $next($request);
    }
}
