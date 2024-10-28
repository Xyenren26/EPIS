<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

// Routes for login
Route::get('/', [LoginController::class, 'showLogin'])->name('login'); // Default route
Route::post('/login', [LoginController::class, 'login']);

// Routes for signup
Route::get('/signup', [SignupController::class, 'showSignup'])->name('signup');
Route::post('/signup', [SignupController::class, 'handleSignup']);

// Routes for forgot password
Route::get('/forgotpassword', [ForgotPasswordController::class, 'showForgotPassword']);

// Route for home
Route::get('/home', [HomeController::class, 'showHome'])->name('home');

// Route for profile
Route::get('/profile', [ProfileController::class, 'showProfile']);

// Route for contact
Route::get('/contact', [ContactController::class, 'showContact']);

// Route for admin
Route::get('/admin', [AdminController::class, 'showAdmin']);
