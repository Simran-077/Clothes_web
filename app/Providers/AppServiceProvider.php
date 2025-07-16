<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;   
use App\Models\Category;               

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share active categories with ALL views (layouts, menus, etc)
        View::composer('*', function ($view) {
            $view->with('categories', Category::where('status', true)->get());
        });
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}
