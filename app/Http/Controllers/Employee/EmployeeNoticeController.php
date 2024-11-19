<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TicketingTable;

class EmployeeNoticeController extends Controller
{
    public function showNotice(Request $request)
    {
        $employeeid = $request->user()->EmployeeID;

        // Eager load the technical support related to the notices
        $tickets = TicketingTable::where('EmployeeID', $employeeid)
                                 ->with('technicalSupport') // Eager load the technical support
                                 ->get();

        

        return view('employee.ticketing.notice', compact('tickets'));
    }
}