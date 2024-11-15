<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller; 
use App\Models\TicketingTable;
use App\Models\AccountTable;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmployeeTicketController extends Controller
{
    public function showTicketing()
    {
        // Fetch technical support staff who are clocked in and not on break
        $unselectedTechSupport = AccountTable::where('AccountType', 'technical-support')
                                            ->whereNotNull('time_in') // Available based on time_in
                                            ->where('on_break', false) // Not on break
                                            ->where('is_selected', false) // Not yet selected
                                            ->get();

        // Check if no technical support is available
        if ($unselectedTechSupport->isEmpty()) {
            // If all tech support staff have been selected, reset `is_selected` for everyone
            AccountTable::where('AccountType', 'technical-support')->update(['is_selected' => false]);

            // Re-fetch unselected tech support after reset
            $unselectedTechSupport = AccountTable::where('AccountType', 'technical-support')
                                                ->whereNotNull('time_in')
                                                ->where('on_break', false)
                                                ->where('is_selected', false)
                                                ->get();
        }

        // Set a flag if no support is available even after reset
        $noSupportAvailable = $unselectedTechSupport->isEmpty();

        // Select a tech support if available
        $selectedTechSupport = null;
        if (!$noSupportAvailable) {
            $selectedTechSupport = $unselectedTechSupport->random();
            $selectedTechSupport->is_selected = true;
            $selectedTechSupport->save();
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

        // Pass tech support data, control number, and no-support flag to the view
        return view('employee.ticketing.ticketing', compact('selectedTechSupport', 'nextControlNo', 'noSupportAvailable'));
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
            'otherConcern' => 'nullable|string',
        ]);

        // Use the 'otherConcern' value if 'concern' is "other"
        $concern = $validated['concern'] === 'other' && !empty($validated['otherConcern']) 
            ? $validated['otherConcern'] 
            : $validated['concern'];

        // Generate the next control number
        $prefix = 'TS-' . Carbon::now()->year . '-';
        $lastControlNo = TicketingTable::where('control_no', 'LIKE', "{$prefix}%")
                                       ->orderBy('control_no', 'desc')
                                       ->first();

        $lastNumber = $lastControlNo ? (int)substr($lastControlNo->control_no, -4) : 0;
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        $nextControlNo = $prefix . $newNumber;

        // Save the ticket to the ticketing table with the generated control number
        TicketingTable::create([
            'control_no' => $nextControlNo,
            'fname' => $validated['first-name'],
            'lname' => $validated['last-name'],
            'Department' => $validated['department'],
            'Concern' => $concern,
            'EmployeeID' => $validated['employeeId'],
            'Technical_Supported' => $validated['technicalSupport'],
            'TimeIn' => $validated['timeIn'],
            'TimeOut' => $validated['timeOut'],
            'status' => 'pending',
        ]);

        return redirect()->route('employee.ticketing.ticketing')->with('success', 'Ticket has been submitted.');
    }
}
