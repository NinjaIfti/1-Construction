<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Product page route
Route::view('/product', 'layouts.pages.product')->name('product');

// Solutions route
Route::view('/solutions', 'layouts.pages.solutions')->name('solutions');

// Resources route
Route::view('/resources', 'layouts.pages.resources')->name('resources');

// Contact route
Route::view('/contact', 'layouts.pages.contact')->name('contact');

// Get Started route
Route::view('/get-started', 'layouts.pages.getStarted')->name('get-started');

// Custom login route - override default auth route
Route::view('/login', 'layouts.pages.login')->name('login.custom')->middleware('guest');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
// temporary admin routes
Route::view('/admin.dashboard', 'layouts.admin.dashboard')->name('admin.dashboard');
Route::view('/client.dashboard', 'layouts.client.dashboard')->name('client.dashboard');
require __DIR__.'/auth.php';
