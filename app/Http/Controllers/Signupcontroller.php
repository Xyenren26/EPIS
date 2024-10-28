<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountTable; // Make sure to import your model
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Carbon\Carbon; // Import Carbon for date manipulation

class SignupController extends Controller
{
    public function showSignup()
    {
        return view('signup');
    }

    public function handleSignup(Request $request)
    {
        // Validate the request data
        $request->validate([
            'username' => 'required|string|max:255|unique:account_tables,username',
            'employee-id' => 'required|string|max:255|unique:account_tables,EmployeeID',
            'email' => 'required|email|max:255|unique:account_tables,email',
            'phone-number' => 'required|string|max:15',
            'AccountType' => 'required|string', // Adjusted to AccountType
            'first-name' => 'required|string|max:255',
            'last-name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'address' => 'required|string|max:255',
            'dob' => 'required|date',
            'password' => 'required|string|min:8|confirmed:confirm-password', // Ensure confirmation field matches
        ], [
            'password.confirmed' => 'The password confirmation does not match.', // Custom error message
        ]);
    
        // Calculate Age from the provided BirthDate
        $birthDate = Carbon::createFromFormat('Y-m-d', $request->dob);
        $age = Carbon::now()->diffInYears($birthDate);
    
        // Create a new user account
        $account = new AccountTable();
        $account->username = $request->username;
        $account->EmployeeID = $request->{'employee-id'};
        $account->email = $request->email;
        $account->PhoneNumber = $request->{'phone-number'};
        $account->AccountType = $request->AccountType; // Adjusted to AccountType
        $account->FirstName = $request->{'first-name'};
        $account->LastName = $request->{'last-name'};
        $account->Suffix = $request->suffix;
        $account->Address = $request->address;
        $account->BirthDate = $request->dob;
        $account->Age = $age; // Assign calculated age
        $account->Password = Hash::make($request->password); // Hash the password before saving
    
        // Save the account to the database
        $account->save();
    
        // Redirect to the login page after successful signup
        return redirect()->route('login')->with('success', 'Account created successfully!'); // Assuming you named the login route 'login'
    }
}    