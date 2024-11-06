<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClearExpiredSession
{
    public function handle($request, Closure $next)
    {
        $username = $request->input('username');
        $sessionLifetime = config('session.lifetime');

        if ($username) {
            // Retrieve the user's session data from the database
            $user = DB::table('account_tables')
                ->where('Username', $username)
                ->first(['EmployeeID', 'last_activity']);

                if ($user && $user->last_activity) {
                    $lastActivity = Carbon::parse($user->last_activity); // Convert to Carbon instance
                
                    if ($lastActivity->diffInMinutes(now()) >= $sessionLifetime) {
                        // Clear session_id and last_activity for expired sessions
                        DB::table('account_tables')
                            ->where('EmployeeID', $user->EmployeeID)
                            ->update([
                                'session_id' => null,
                                'remember_token' => null,
                                'last_activity' => null,
                                'time_in' => null,
                            ]);
                         // Remove the session from the database based on user_id (EmployeeID)
                        \DB::table('sessions')
                        ->where('user_id', $user->EmployeeID)
                        ->delete();

                        // Log the user out
                        Auth::logout(); 
                        
                        // Clear all session data
                        session()->flush(); 

                        // Optionally regenerate the session to avoid session fixation attacks
                        session()->regenerate(); 
                    }
                }
        }

        return $next($request);
    }
}
