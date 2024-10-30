<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\ClearExpiredSessions; // Import your middleware
use App\Http\Middleware\UpdateLastActivity; // Import your middleware

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register custom middleware
        $middleware -> alias ([
            'ClearExpiredSessions'=> \App\Http\Middleware\ClearExpiredSessions::class,
            'UpdateLastActivity'=> \App\Http\Middleware\UpdateLastActivity::class,
        ]);
    })
        
       
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
