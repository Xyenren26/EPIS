<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\AccountTable;

class LoginController extends Controller
{
    // Show the login form
    public function showLogin()
    {
        return view('login'); // Refers to resources/views/login.blade.php
    }

    // Handle login logic
    public function login(Request $request)
    {
        // Validate input with custom messages
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Please enter your username.',
            'password.required' => 'Please enter your password.',
        ]);
    
        // Retrieve the account from the account_tables table
        $account = AccountTable::where('Username', $request->username)->first(); 
    
        // Check if account exists and password matches
        if ($account && Hash::check($request->password, $account->Password)) {
            // Successful login
            // Store session data
            session(['user_id' => $account->EmployeeID]);
    
            // Redirect to the home page
            return redirect()->route('home');
        } else {
            // Failed login, redirect back with an error
            return redirect()->back()->withErrors([
                'login' => 'Invalid username or password.',
            ])->withInput();
        }
    }    
}
