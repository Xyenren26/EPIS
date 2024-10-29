<?php

namespace App\Http\Controllers;

use App\Models\AccountTable; // Import the AccountTable model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class Admincontroller extends Controller
{
    public function showAdmin()
    {
        // Fetch all active accounts
        $activeAccounts = AccountTable::where('status', 'active')->get();

        // Fetch pending accounts
        $pendingAccounts = AccountTable::where('status', 'pending')->get();

        // Pass the active and pending account data to the view
        return view('admin', [
            'activeAccounts' => $activeAccounts,
            'pendingAccounts' => $pendingAccounts
        ]);
    }

    public function acceptAccount($employeeID)
    {
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
