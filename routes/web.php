<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Product page route
Route::view('/product', 'layouts.pages.product')->name('product');

// Solutions route
Route::view('/solutions', 'layouts.solutions')->name('solutions');

// Resources route
Route::view('/resources', 'layouts.resources')->name('resources');

// Contact route
Route::view('/contact', 'layouts.contact')->name('contact');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
