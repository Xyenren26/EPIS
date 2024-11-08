<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AdminController;
// Controllers for technical-support and technical-administrator
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
// Employee-specific controllers
use App\Http\Controllers\Employee\EmployeeHomeController;
use App\Http\Controllers\Employee\EmployeeTicketController;
use App\Http\Controllers\Employee\EmployeeProfileController;
use App\Http\Controllers\Employee\EmployeeContactController;

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

// Routes for technical-support and technical-administrator (protected by 'auth' middleware)
Route::middleware(['auth', \App\Http\Middleware\UpdateLastActivity::class])->group(function () {
    // Original home route for technical users
    Route::get('/home', [HomeController::class, 'showHome'])->name('home');
    
    // Ticketing routes
    Route::get('/ticketing/ticketing', [TicketController::class, 'showTicketing'])->name('ticketing.ticketing');
    Route::post('/ticket', [TicketController::class, 'storeTicket']);

    // Profile and Contact routes for technical users
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::put('/profile/{employeeID}', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/update-profile-picture', [ProfileController::class, 'updateProfilePicture'])->name('update.profile.picture');
    Route::get('/contact', [ContactController::class, 'showContact']);
    
    // Inventory routes
    Route::get('/in-inventory', [InventoryController::class, 'showInventory']);
    Route::get('/out-inventory', [InventoryController::class, 'showOutInventory']);
    Route::get('/deployment', [InventoryController::class, 'showDeployment']);
    Route::get('/all-inventory', [InventoryController::class, 'showAllInventory']);

    // Admin routes
    Route::get('/admin', [AdminController::class, 'showAdmin']);
    Route::post('/admin/accept/{employeeID}', [AdminController::class, 'acceptAccount']);
    Route::delete('/admin/void/{employeeID}', [AdminController::class, 'voidAccount']);
});

// Routes for client users (protected by 'auth' middleware)
Route::middleware(['auth', \App\Http\Middleware\UpdateLastActivity::class])->group(function () {
    // Employee-specific home route
    Route::get('/employee/home', [EmployeeHomeController::class, 'showEmployeeHome'])->name('employee.home');

    // Ticketing routes
    Route::get('/employee/ticketing/ticketing', [EmployeeTicketController::class, 'showTicketing']);
    Route::get('/employee/ticket', [EmployeeTicketController::class, 'create']);
    Route::post('/employee/ticket', [EmployeeTicketController::class, 'store']);

    // Employee-specific profile and contact routes
    Route::get('/employee/profile', [EmployeeProfileController::class, 'showEmployeeProfile'])->name('employee.profile.show');
    Route::put('/employee/profile/{employeeID}', [EmployeeProfileController::class, 'EmployeeUpdate'])->name('employee.profile.update');
    Route::post('/employee/update-profile-picture', [EmployeeProfileController::class, 'EmployeeUpdateProfilePicture'])->name('employee.update.profile.picture');
    Route::get('/employee/contact', [EmployeeContactController::class, 'showEmployeeContact'])->name('employee.contact');
});
