<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\Middleware\StartSession;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\CheckIsAdmin;
use App\Http\Middleware\BasketIsNotEmpty;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Reģistrē sesijas middleware
        $middleware->append(StartSession::class);

        // Reģistrē pielāgotos middleware
        $middleware->alias([
            'is_admin' => CheckIsAdmin::class,
            'basket_not_empty' => BasketIsNotEmpty::class,
        ]);

        // Pievieno SetLocale middleware
        $middleware->append(SetLocale::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();