<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

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
        // Make current user available in all views, including error views
        View::composer('*', function ($view) {
            $view->with('currentUser', auth()->user());
        });
        
        // Share current year with all views
        View::share('currentYear', date('Y'));
        
        // Set a default string length for MySQL older than 5.7.7
        Schema::defaultStringLength(191);
        
        // In local development, prevent lazy loading
        if ($this->app->environment('local')) {
            Model::preventLazyLoading(!$this->app->isProduction());
        }
    }
}