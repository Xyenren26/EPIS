<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\AccountTable;

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
    
        // Retrieve the user by username
        $user = AccountTable::where('Username', $request->username)->first();
        
        if ($user) {
            // Check if the user is a Technical-Admin and if the status is pending
            if ($user->AccountType === 'technical-administrator' && $user->status === 'pending') {
                return redirect()->back()->withErrors([
                    'login' => 'Your account is pending activation. Please contact the administrator.',
                ])->withInput();
            }
    
            // Check if the user already has an active session
            if ($user->session_id) {
                return redirect()->back()->withErrors([
                    'login' => 'You are already logged in from another session. Please log out first.',
                ])->withInput();
            }
    
            // Check if the user should be remembered
            $remember = $request->has('remember');
            
            // Authenticate the user
            if (Auth::attempt(['Username' => $request->username, 'password' => $request->password], $remember)) {
                // Set the session user_id
                session(['user_id' => $user->EmployeeID]);
                
                // Set the current time as last_activity in the session
                session(['last_activity' => now()]);
                
                // Update last_activity in the database
                $user->last_activity = now();  // Save current timestamp
                $user->session_id = session()->getId(); // Save the current session ID
                $user->save(); // Save the user with updated session_id and last_activity
                
                // Redirect to the home page on successful login
                return redirect()->route('home');
            }
        }
    
        // Failed login, redirect back with an error
        return redirect()->back()->withErrors([
            'login' => 'Invalid username or password.',
        ])->withInput();
    }
    
    
    public function logout()
    {
        $user = Auth::user();
        
        if ($user) {
            // Clear the session ID and remember token in the database
            $user->session_id = null; 
            $user->remember_token = null; // Clear the remember token
            $user->save();
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
