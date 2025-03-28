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
            'globalrole' => \App\Http\Middleware\CheckGlobalRole::class,
            'isProjectMember' => \App\Http\Middleware\UserIsMember::class,
            'csrf' => Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            'protectOwnership' => \App\Http\Middleware\ProtectOwnership::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
