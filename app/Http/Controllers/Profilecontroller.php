<?php

namespace App\Http\Controllers;

use App\Models\AccountTable; // Import the AccountTable model
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfile()
    {
        // Fetch the first record from account_tables
        $account = AccountTable::first();

        // Pass the data to the profile Blade view
        return view('profile', ['account' => $account]);
    }
}
