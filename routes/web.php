<?php

use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Routes for login
Route::get('/', [LoginController::class, 'showLogin'])->name('login'); // Default route
Route::post('/login', [LoginController::class, 'login'])->middleware('ClearExpiredSession');


// Routes for logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routes for signup
Route::get('/signup', [SignupController::class, 'showSignup'])->name('signup');
Route::post('/signup', [SignupController::class, 'handleSignup']);

// Routes for forgot password
Route::get('/forgotpassword', [ForgotPasswordController::class, 'showForgotPassword']);

// Protecting routes using 'auth' middleware
Route::middleware(['auth', \App\Http\Middleware\UpdateLastActivity::class])->group(function () {
    // Route for home
    Route::get('/home', [HomeController::class, 'showHome'])->name('home');

    // Route for ticketing
    Route::get('/ticketing/ticketing', [TicketController::class, 'showTicketing']);
    Route::get('/ticket', [TicketController::class, 'create']);
    Route::post('/ticket', [TicketController::class, 'store']);

    // Route for profile
    Route::get('/profile', [ProfileController::class, 'showProfile']);

    // Route for contact
    Route::get('/contact', [ContactController::class, 'showContact']);

    // Route for admin
    Route::get('/admin', [AdminController::class, 'showAdmin']);
    
    // Accept an account (set status to active)
    Route::post('/admin/accept/{employeeID}', [AdminController::class, 'acceptAccount']);

    // Void an account (delete it)
    Route::delete('/admin/void/{employeeID}', [AdminController::class, 'voidAccount']);
});
