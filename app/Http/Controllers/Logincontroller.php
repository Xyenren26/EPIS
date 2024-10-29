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

    public function login(Request $request){
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

        // Proceed to authenticate the user
        if (Auth::attempt(['Username' => $request->username, 'password' => $request->password])) {
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
        Auth::logout(); // Log the user out
        return redirect()->route('login');
    }
}
