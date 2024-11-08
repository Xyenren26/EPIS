<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller; 
use App\Models\TicketingTable;
use App\Models\AccountTable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeTicketController extends Controller
{
    public function showTicketing()
{
    // Fetch available technical support staff who have a Time_in value set (not null)
    $techSupport = AccountTable::where('AccountType', 'technical-support')
                               ->whereNotNull('time_in')  // Check if 'time_in' is not null
                               ->get();

    // Check if there are available technical support staff
    if ($techSupport->isEmpty()) {
        $noTechMessage = '';  // Set the message if no tech support is available
    } else {
        $noTechMessage = null;  // No message if there is tech support available
    }

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
    return view('employee.ticketing.ticketing', [
        'techSupport' => $techSupport,
        'nextControlNo' => $nextControlNo,
        'noTechMessage' => $noTechMessage,  // Always pass the noTechMessage
    ]);
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
            'timeIn' => 'required|date',
            'timeOut' => 'nullable|date',
        ]);

        // Fetch available technical support staff who have a Time_in value set (not null)
        $techSupport = AccountTable::where('AccountType', 'technical-support')
                                   ->whereNotNull('time_in')  // Check if 'time_in' is not null
                                   ->get();

        // Check if there are available technical support staff
        if ($techSupport->isEmpty()) {
            return redirect()->route('employee.ticketing.ticketing')->with('error', 'No available tech-support at the moment.');
        }

        // Round-robin selection of tech support
        $techSupportCount = $techSupport->count();
        $lastAssignedTech = session('last_assigned_tech', -1); // Keep track of last assigned tech

        // Get the next tech to assign based on round-robin
        $nextTechIndex = ($lastAssignedTech + 1) % $techSupportCount;
        $selectedTech = $techSupport[$nextTechIndex];

        // Store the selected tech in session for next round
        session(['last_assigned_tech' => $nextTechIndex]);

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
            'FirstName' => $validated['first-name'],
            'LastName' => $validated['last-name'],
            'Department' => $validated['department'],
            'Concern' => $validated['concern'],
            'EmployeeID' => $validated['employeeId'],
            'TechnicalSupportID' => $selectedTech->EmployeeID,
            'TimeIn' => $validated['timeIn'],
            'TimeOut' => $validated['timeOut'],
        ]);

        return redirect()->route('employee.ticketing.ticketing')->with('success', 'Ticket has been submitted.');
    }
}
