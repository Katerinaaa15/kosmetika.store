<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;


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
        // Izgūst visas kategorijas un padod visos skatos kā $categories
        View::share('categories', Category::orderBy('name')->get());
        Blade::if('admin', function(){
            return Auth::check() && Auth::user()->isAdmin();
        });

        Paginator::useBootstrapFive();
    }
}
