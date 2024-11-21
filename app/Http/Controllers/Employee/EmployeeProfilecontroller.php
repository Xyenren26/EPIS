<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller; 
use App\Models\AccountTable; // Import the AccountTable model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Illuminate\Http\Request;

class EmployeeProfileController extends Controller
{
    public function showEmployeeProfile()
    {
        // Retrieve the authenticated user
        $account = Auth::user();

        // Check if the user is authenticated
        if (!$account) {
            // Redirect to login if no authenticated user is found
            return redirect()->route('login')->withErrors(['login' => 'Please log in again.']);
        }

        // Pass the account data to the profile Blade view
        return view('employee.profile', ['account' => $account]);
    }

    public function EmployeeUpdate(Request $request, $employeeID)
    {
        // Validate the form inputs
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'birthdate' => 'required|date',
            'age' => 'required|integer',
            'gender' => 'required|string|max:10',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional: file validation for profile picture
        ]);

        // Find the account using EmployeeID
        $account = AccountTable::findOrFail($employeeID);
    
        // Update the profile details
        $account->FirstName = $request->firstname;
        $account->LastName = $request->lastname;
        $account->Suffix = $request->suffix;
        $account->BirthDate = $request->birthdate;
        $account->Age = $request->age;
        $account->Gender = $request->gender;
        $account->Email = $request->email;
        $account->Address = $request->address;
        $account->PhoneNumber = $request->phone;

        // Handle profile picture upload if a new one is uploaded
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $account->ProfilePicture = file_get_contents($profilePicture);
        }

        // Save the updated account data
        $account->save();

        return redirect()->route('employee.profile.show')->with('success', 'Profile updated successfully!');
    }

    public function EmployeeUpdateProfilePicture(Request $request)
    {
        // Get the logged-in user's account
        $account = AccountTable::find(session('user_id'));

        // Check if a file is uploaded
        if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
            // Store the image
            $image = $request->file('profile_picture');
            $imageData = file_get_contents($image->getRealPath());

            // Update the profile picture (stored as BLOB)
            $account->ProfilePicture = $imageData;
            $account->save();

            // Redirect back to the profile page with a success message
            return redirect()->route('employee.profile.show')->with('success', 'Profile picture updated successfully!');
        }

        // Redirect back with an error message if no valid file is uploaded
        return redirect()->route('employee.profile.show')->with('error', 'Failed to upload profile picture. Please try again.');
    }
    public function changePassword(Request $request)
    {
        // Get the user ID from the session
        $userId = session('user_id');
        
        // Check if the session contains the user ID
        if (!$userId) {
            return back()->withErrors(['error' => 'Session expired. Please log in again.']);
        }
        
        // Validate the input
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => [
                'required',
                'min:8',
                'confirmed', // Ensure confirmPassword matches newPassword
                'regex:/[A-Z]/', // At least one uppercase
                'regex:/[a-z]/', // At least one lowercase
                'regex:/[0-9]/', // At least one number
                'regex:/[@$!%*?&#]/', // At least one special character
            ],
        ], [
            'newPassword.regex' => 'Password must include uppercase, lowercase, number, and special character.',
            'newPassword.confirmed' => 'New password and confirmation do not match.',
        ]);
    
        // Fetch the user from the database
        $user = AccountTable::find($userId);
        if (!$user) {
            return back()->withErrors(['error' => 'User not found.']);
        }
        
        // Verify the old password
        if (!Hash::check($request->oldPassword, $user->Password)) {
            return back()->withErrors(['oldPassword' => 'The provided old password does not match our records.']);
        }
    
        // Update the password
        $user->Password = Hash::make($request->newPassword);
        $user->save();
        
        // Return success response
        return back()->with('success', 'Password changed successfully.');
    }
}

