<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;

class EmployeeContactController extends Controller
{
    public function showEmployeeContact()
    {
        return view('employee.contact'); // Refers to resources/views/home.blade.php
    }
}
