<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   public function boot(): void
{
    // Tava esošā konfigurācija
    View::share('categories', Category::orderBy('name')->get());

    Blade::if('admin', function(){
        return Auth::check() && Auth::user()->isAdmin();
    });

    Paginator::useBootstrapFive();

    // Formatēšana Monologam (uzmanīgi ar Laravel Herd)
    $monolog = Log::getLogger(); // Iegūst Monolog instance

    foreach ($monolog->getHandlers() as $handler) {
        $handler->setFormatter(
            new LineFormatter("[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n", null, true, true)
        );
    }
}}
