<?php

namespace App\Http\Controllers;

use App\Models\AccountTable; // Import the AccountTable model
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHome()
    {
        return view('home'); // Refers to resources/views/home.blade.php
    }
}