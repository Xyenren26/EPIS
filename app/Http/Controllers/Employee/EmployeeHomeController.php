<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;

class EmployeeHomeController extends Controller
{
    public function showEmployeeHome()
    {
        return view('employee.home'); // Refers to resources/views/employee/home.blade.php
    }
}
