<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use App\Models\AccountTable;
use Carbon\Carbon;

class UpdateLastActivity
{
    public function handle($request, Closure $next)
    {
        if (session()->has('user_id')) {
            $userId = session('user_id');

            // Retrieve the user using the user ID stored in the session
            $user = AccountTable::find($userId);

            if ($user) {
                // Update last_activity in the database and session
                $user->last_activity = now(); // Update last_activity
                $user->save(); // Save changes to the database

                // Update last_activity in the session
                session(['last_activity' => now()]);
            } else {
                // Redirect to the login page with an error message
                return redirect('/')->with('error', 'Account not found.'); // Adjust the route as needed
            }
        }

        return $next($request);
    }
}
