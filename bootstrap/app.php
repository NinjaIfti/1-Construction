<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            // Admin access middleware - restricts access to admin users only
            'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
            
            // Contractor verification middleware - ensures contractors are verified
            'verified.contractor' => \App\Http\Middleware\VerifiedContractorMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
