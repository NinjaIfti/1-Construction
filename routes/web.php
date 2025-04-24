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

// Who We Serve routes
Route::view('/who-we-serve', 'layouts.pages.who-we-serve')->name('who-we-serve');
Route::view('/who-we-serve/home-builder', 'layouts.pages.HomeBuilder')->name('who-we-serve.home-builder');
Route::view('/who-we-serve/developers', 'layouts.pages.developers')->name('who-we-serve.developers');
Route::view('/who-we-serve/GeneralContractor', 'layouts.pages.GeneralContractor')->name('who-we-serve.GeneralContractor');
Route::view('/who-we-serve/sub-contractor', 'layouts.pages.subcontractor')->name('who-we-serve.sub-contractor');
Route::view('/who-we-serve/solar-ev', 'layouts.pages.solar-ev')->name('who-we-serve.solar-ev');
Route::view('/who-we-serve/architect', 'layouts.pages.architect')->name('who-we-serve.architect');

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
