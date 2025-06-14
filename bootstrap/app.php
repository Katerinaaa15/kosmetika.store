<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\Middleware\StartSession;

use App\Http\Middleware\SetLocale;
use App\Http\Middleware\CheckIsAdmin;
use App\Http\Middleware\BasketIsNotEmpty;
use App\Http\Middleware\CheckIfBanned;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Http\Middleware\LogIpMiddleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        $middleware->append(StartSession::class);
        $middleware->append(ShareErrorsFromSession::class);   
        $middleware->append(SetLocale::class);      
        $middleware->append(CheckIfBanned::class); 
        $middleware->append(LogIpMiddleware::class); 

        
        $middleware->alias([
            'is_admin'         => CheckIsAdmin::class,
            'basket_not_empty' => BasketIsNotEmpty::class,
            'check_banned'     => CheckIfBanned::class, 
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        
    })->create();
