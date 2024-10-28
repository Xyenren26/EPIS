<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Contactcontroller extends Controller
{
    public function showContact()
    {
        return view('contact'); // Refers to resources/views/home.blade.php
    }
}
