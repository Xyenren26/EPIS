<?php
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// Heartbeat route to update user activity
Route::post('/heartbeat', function () {
    $userId = session('user_id');
    if ($userId) {
        DB::table('account_tables')
            ->where('EmployeeID', $userId)
            ->update(['updated_at' => now()]);
    }
    return response()->json(['status' => 'Heartbeat received']);
});

// Routes for login
Route::get('/', [LoginController::class, 'showLogin'])->name('login'); // Default route
Route::post('/login', [LoginController::class, 'login']);

// Routes for logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routes for signup
Route::get('/signup', [SignupController::class, 'showSignup'])->name('signup');
Route::post('/signup', [SignupController::class, 'handleSignup']);

// Routes for forgot password
Route::get('/forgotpassword', [ForgotPasswordController::class, 'showForgotPassword']);

// Protecting routes using 'auth' middleware
Route::middleware([\App\Http\Middleware\UpdateLastActivity::class, \App\Http\Middleware\ClearExpiredSessions::class])->group(function () {
    // Route for home
    Route::get('/home', [HomeController::class, 'showHome'])->name('home');

    // Route for ticketing
    Route::get('/ticketing', [TicketingController::class, 'showTicketing']);

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
