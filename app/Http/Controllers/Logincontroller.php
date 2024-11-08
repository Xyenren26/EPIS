<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\AccountTable; // to gain access to models
use Illuminate\Support\Facades\Config; // use to adjust the session limit

class LoginController extends Controller
{
    public function showLogin()
    {
        // Check if the user is already authenticated
        if (Auth::check()) {
            return redirect()->route('home'); // Redirect to home if logged in
        }

        return view('login'); // Refers to resources/views/login.blade.php
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Please enter your username.',
            'password.required' => 'Please enter your password.',
        ]);

        $user = AccountTable::where('Username', $request->username)->first();

        if ($user) {
            if ($user->AccountType === 'technical-administrator' && $user->status === 'pending') {
                return redirect()->back()->withErrors([
                    'login' => 'Your account is pending activation. Please contact the administrator.',
                ])->withInput();
            }

            if ($user->session_id) {
                return redirect()->back()->withErrors([
                    'login' => 'You are already logged in from another session. Please log out first.',
                ])->withInput();
            }

            $remember = $request->has('remember');

            // Set session lifetime based on "Remember Me"
            if ($remember) {
                Config::set('session.lifetime', env('REMEMBER_ME_LIFETIME', 43200));
                Config::set('session.expire_on_close', false); // Session persists even when the browser is closed
            } else {
                Config::set('session.lifetime', env('SESSION_LIFETIME', 5));
                Config::set('session.expire_on_close', true); // Session expires when the browser is closed
            }

            if (Auth::attempt(['Username' => $request->username, 'password' => $request->password], $remember)) {
                session(['user_id' => $user->EmployeeID]);
                session(['last_activity' => now()]);

                // Set time_in and time_out to null upon successful login
                $user->time_in = now(); // Set time_in when logged in
                $user->time_out = null;  // Ensure time_out is null when logged in
                $user->last_activity = now();
                $user->session_id = session()->getId();
                $user->save();

                // Redirect based on account type
                if ($user->AccountType === 'employee') {
                    return redirect('/employee/home'); // Redirect employee to the client folder
                } elseif (in_array($user->AccountType, ['technical-support', 'technical-administrator'])) {
                    return redirect()->route('home'); // Redirect technical roles to main home
                }
            }
        }

        return redirect()->back()->withErrors([
            'login' => 'Invalid username or password.',
        ])->withInput();
    }

    public function logout()
    {
        $user = Auth::user();
    
        if ($user) {
            // Set time_in to null and set time_out when logging out
            $user->time_in = null;  // Clear time_in upon logout
            $user->time_out = now(); // Set time_out to current time when logging out
            $user->session_id = null;
            $user->remember_token = null; // Clear the remember token
            $user->last_activity = null;
            $user->save();
    
            // Remove the session from the database based on user_id (EmployeeID)
            \DB::table('sessions')
                ->where('user_id', $user->EmployeeID) // Assuming user_id in the sessions table maps to EmployeeID
                ->delete();
        }
    
        // Log the user out
        Auth::logout();
    
        // Clear all session data
        session()->flush();
    
        // Optionally regenerate the session to avoid session fixation attacks
        session()->regenerate();
    
        // Remove the remember_me cookie
        return redirect()->route('login')->withCookie(\Cookie::forget('remember_web'));
    }
}    
