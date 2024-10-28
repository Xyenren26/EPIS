<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Forgotpasswordcontroller extends Controller
{
    public function showForgotPassword()
    {
        return view('forgotpassword'); // Refers to resources/views/home.blade.php
    }
}
