<?php

namespace App\Http\Controllers;

use App\Models\TicketingTable;
use App\Models\AccountTable;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TicketController extends Controller
{
    public function showTicketing()
    {
        // Fetch technical support staff who have a Time_in value set (not null)
        $techSupport = AccountTable::where('AccountType', 'technical-support')
                                   ->whereNotNull('time_in')  // Check if 'time_in' is not null
                                   ->get();

        // Generate the next control number
        $prefix = 'TS-' . Carbon::now()->year . '-';
        $lastControlNo = TicketingTable::where('control_no', 'LIKE', "{$prefix}%")
                                       ->orderBy('control_no', 'desc')
                                       ->first();
        
        // Determine the next control number
        $lastNumber = $lastControlNo ? (int)substr($lastControlNo->control_no, -4) : 0;
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        $nextControlNo = $prefix . $newNumber;

        // Pass the tech support data and the next control number to the view
        return view('ticketing.ticketing', compact('techSupport', 'nextControlNo'));
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
        'technicalSupport' => 'required|string',
        'timeIn' => 'required|date',
        'timeOut' => 'nullable|date',
        'otherConcern' => 'nullable|string',  // Ensure that otherConcern is optional
    ]);

    // If 'concern' is "other", use the value from 'otherConcern'
    $concern = $validated['concern'] === 'other' && !empty($validated['otherConcern']) 
        ? $validated['otherConcern'] 
        : $validated['concern'];

    // Generate the next control number
    $prefix = 'TS-' . Carbon::now()->year . '-';
    $lastControlNo = TicketingTable::where('control_no', 'LIKE', "{$prefix}%")
                                   ->orderBy('control_no', 'desc')
                                   ->first();

    // Determine the next control number
    $lastNumber = $lastControlNo ? (int)substr($lastControlNo->control_no, -4) : 0;
    $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
    $nextControlNo = $prefix . $newNumber;

    // Save the ticket to the ticketing table with the generated control number
    TicketingTable::create([
        'control_no' => $nextControlNo,
        'fname' => $validated['first-name'],
        'lname' => $validated['last-name'],
        'Department' => $validated['department'],
        'Concern' => $concern,  // Save the concern, whether it's the selected option or the specified 'other'
        'EmployeeID' => $validated['employeeId'],
        'Technical_Supported' => $validated['technicalSupport'],
        'TimeIn' => $validated['timeIn'],
        'TimeOut' => $validated['timeOut'],
        'status' => 'pending',
    ]);

    return redirect()->route('ticketing.ticketing')->with('success', 'Ticket has been submitted.');
}
public function showResult(Request $request)
{
    // Fetch all ticketing records
    $tickets = TicketingTable::all();

    // Pass the tickets to the search result view
    return view('ticketing.searchresult', compact('tickets'));
}
}
