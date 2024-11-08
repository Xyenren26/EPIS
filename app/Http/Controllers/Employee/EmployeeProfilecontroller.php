<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller; 
use App\Models\AccountTable; // Import the AccountTable model
use Illuminate\Http\Request;

class EmployeeProfileController extends Controller
{
    public function showEmployeeProfile()
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
}
