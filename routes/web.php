<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Product page route
Route::view('/product', 'product')->name('product');

// Solutions route
Route::view('/solutions', 'solutions')->name('solutions');

// Resources route
Route::view('/resources', 'resources')->name('resources');

// Contact route
Route::view('/contact', 'contact')->name('contact');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
