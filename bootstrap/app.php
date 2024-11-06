<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use App\Http\Middleware\ClearExpiredSession; // Import your middleware
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
            'UpdateLastActivity'=> \App\Http\Middleware\UpdateLastActivity::class,
            'ClearExpiredSession'=> \App\Http\Middleware\ClearExpiredSession::class,
        ]);
    })
        
       
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
