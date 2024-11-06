<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\AccountTable;
use Illuminate\Http\Request;

class TicketController extends Controller{
    public function showTicketing()
    {
        // Fetch technical support staff who have a Time_in value set (not null)
        $techSupport = AccountTable::where('AccountType', 'technical-support')
                                    ->whereNotNull('time_in')  // Check if 'time_in' is not null
                                    ->get();
    
        // Pass the data to the view
        return view('ticketing.ticketing', compact('techSupport'));
    }

    public function storeTicket(Request $request)
    {
        // Validate and store the ticket information
        $validated = $request->validate([
            'first-name' => 'required|string',
            'last-name' => 'required|string',
            'department' => 'required|string',
            'concern' => 'required|string',
            'employeeId' => 'required|string',
            'technicalSupport' => 'required|string',  // Make sure to validate the selected technical support
            'timeIn' => 'required|date',
            'timeOut' => 'nullable|date',
        ]);

        // Save the ticket to the ticketing table
        Ticket::create([
            'FirstName' => $validated['first-name'],
            'LastName' => $validated['last-name'],
            'Department' => $validated['department'],
            'Concern' => $validated['concern'],
            'EmployeeID' => $validated['employeeId'],
            'TechnicalSupportID' => $validated['technicalSupport'],
            'TimeIn' => $validated['timeIn'],
            'TimeOut' => $validated['timeOut'],
        ]);

        return redirect()->route('ticketing.index')->with('success', 'Ticket has been submitted.');
    }
}