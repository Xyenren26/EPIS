<?php

namespace App\Http\Controllers;

use App\Models\AccountTable; // Import the AccountTable model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class Admincontroller extends Controller
{
    public function showAdmin(){
        // Get the currently authenticated user's EmployeeID
        $currentUserId = Auth::user()->EmployeeID;

        // Retrieve the current user's information
        $currentUser = AccountTable::where('EmployeeID', $currentUserId)->first();

        // Fetch pending accounts
        $pendingAccounts = AccountTable::where('status', 'pending')->get();

        // Check if the current user was found
        if (!$currentUser) {
            return redirect()->back()->with('error', 'No employee data found for the logged-in user.');
        }

        // Pass the current user and pending account data to the view
        return view('admin', [
            'currentUser' => $currentUser,
            'pendingAccounts' => $pendingAccounts
        ]);
    }

    public function acceptAccount($employeeID)
{
    // Debugging log
    \Log::info('Employee ID received for acceptance: ' . $employeeID);

    $account = AccountTable::find($employeeID);
    if ($account) {
        $account->status = 'active'; // Update status
        $account->save();
        return response()->json(['success' => true, 'message' => 'Account activated successfully.']);
    }

    return response()->json(['success' => false, 'message' => 'Account not found.']);
}

  
      // Void (delete) an account
      public function voidAccount($employeeID)
      {
          $account = AccountTable::find($employeeID);
          if ($account) {
              $account->delete(); // Delete the account
              return response()->json(['success' => true, 'message' => 'Account deleted successfully.']);
          }
  
          return response()->json(['success' => false, 'message' => 'Account not found.']);
      }

}
