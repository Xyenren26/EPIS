<?php

namespace App\Http\Controllers;

use App\Models\AccountTable; // Import the AccountTable model
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfile()
    {
        // Retrieve the user ID from the session
        $userId = session('user_id');

        // Fetch the account associated with the current user ID
        $account = AccountTable::where('EmployeeID', $userId)->first();

        // Check if the account exists
        if (!$account) {
            // Handle the case where the account is not found (e.g., redirect or show an error)
            return redirect()->route('login')->withErrors(['login' => 'Account not found.']);
        }

        // Pass the account data to the profile Blade view
        return view('profile', ['account' => $account]);
    }
}
