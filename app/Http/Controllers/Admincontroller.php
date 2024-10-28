<?php

namespace App\Http\Controllers;

use App\Models\AccountTable; // Import the AccountTable model
use Illuminate\Http\Request;

class Admincontroller extends Controller
{
    public function showAdmin()
    {
        // Fetch all employee records from account_tables
        $employees = AccountTable::all(); // Fetch all employees

        // Check if any employees were found
        if ($employees->isEmpty()) {
            // Optionally handle the case where no employees are found
            return redirect()->back()->with('error', 'No employees found.');
        }

        // Pass the employee data to the view
        return view('admin', compact('employees')); // Use a view to display the list
    }
}
