<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketingTable;

class TaskController extends Controller
{
    public function showTask(Request $request)
    {
        // Assuming the employee ID of the technical support is accessible from the logged-in user
        $employeeId = $request->user()->EmployeeID;

        // Fetch tickets assigned to the technical support employee based on their EmployeeID
        $tickets = TicketingTable::where('Technical_Supported', $employeeId)->get(); 

        // Pass the tickets to the view
        return view('ticketing.task', compact('tickets')); // Refers to resources/views/ticketing/task.blade.php
    }
}

