<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AccountTable;

class LoginController extends Controller
{
    public function showLogin()
    {
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
                // Return an error message if there's already an active session
                return redirect()->back()->withErrors([
                    'login' => 'You are already logged in from another session. Please log out first.',
                ])->withInput();
            }

            // Proceed to authenticate the user
            if (Auth::attempt(['Username' => $request->username, 'password' => $request->password])) {
                // Set the session user_id and store the current session ID
                session(['user_id' => $user->EmployeeID]);
                $user->session_id = session()->getId(); // Save the current session ID
                $user->save();

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
        // Clear the session ID in the database
        $user->session_id = null; // Clear session ID on logout
        $user->save();
    }

    // Log the user out
    Auth::logout(); 

    // Clear all session data
    session()->flush(); 

    // Optionally regenerate the session to avoid session fixation attacks
    session()->regenerate(); 
}
}