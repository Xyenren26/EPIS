<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TicketingTable;

class EmployeeNoticeController extends Controller
{
    public function showNotice(Request $request)
    {
        $employeeid = $request-> user() -> EmployeeID;

        $tickets = TicketingTable::where('EmployeeID', $employeeid)->get();

        return view('employee.ticketing.notice', compact('tickets')); // Refers to resources/views/employee/ticketing/notice.blade.php
    }
}
