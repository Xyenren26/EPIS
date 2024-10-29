<?php

namespace App\Http\Controllers;

use App\Models\AccountTable; // Import the AccountTable model
use Illuminate\Http\Request;

class TicketingController extends Controller
{
    public function showTicketing()
    {
        return view('ticketing'); // Refers to resources/views/ticketing.blade.php
    }
}