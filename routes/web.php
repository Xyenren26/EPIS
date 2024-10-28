<?php

use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'showHome']);

use App\Http\Controllers\ProfileController;

Route::get('/profile', [Profilecontroller::class, 'showProfile']);

use App\Http\Controllers\ContactController;

Route::get('/contact', [Contactcontroller::class, 'showContact']);

use App\Http\Controllers\AdminController;

Route::get('/admin', [Admincontroller::class, 'showAdmin']);



