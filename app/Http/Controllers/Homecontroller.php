<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\TicketingTable;
use Illuminate\Support\Facades\Log;


class HomeController extends Controller
{
    public function showHome(){
        // Get the logged-in user's employee ID
        $employeeId = auth()->user()->EmployeeID;

        // Get the count of pending tasks for this user
        $pendingTasksCount = TicketingTable::where('Technical_Supported', $employeeId)
                                    ->where('Status', 'pending') // Assuming 'status' is used to determine if a task is pending
                                    ->count();
                                    // Log the count of pending tasks
Log::info('Pending tasks count for employee ' . $employeeId . ': ' . $pendingTasksCount);

        return view('home', compact('pendingTasksCount'));
    }
}