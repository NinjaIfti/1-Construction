<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Auth;

Route::middleware('guest')->group(function () {
    Volt::route('register', 'pages.auth.register')
        ->name('register');

    Route::view('login', 'auth.login')->name('login');
    Route::post('login', function() {
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (auth()->attempt($credentials, request()->boolean('remember'))) {
            request()->session()->regenerate();
 
            if (auth()->user()->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                return redirect()->intended(route('client.dashboard'));
            }
        }
 
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    });

    // Social Login Routes
    Route::get('auth/{provider}/redirect', [App\Http\Controllers\Auth\SocialiteController::class, 'redirect'])
        ->name('socialite.redirect');
    Route::get('auth/{provider}/callback', [App\Http\Controllers\Auth\SocialiteController::class, 'callback'])
        ->name('socialite.callback');

    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');
        
    Route::post('logout', function() {
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');
});
