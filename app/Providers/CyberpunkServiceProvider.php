<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class CyberpunkServiceProvider extends ServiceProvider
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
        // Register the 'admin' gate for authorizing admin actions
        Gate::define('admin', function ($user) {
            return $user->is_admin;
        });

        // Create Blade directives for easier authorization in templates
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->is_admin;
        });

        // Create a storage link if it doesn't exist
        if (!file_exists(public_path('storage'))) {
            try {
                File::link(
                    storage_path('app/public'), public_path('storage')
                );
            } catch (\Exception $e) {
                // Log the error but don't halt the application
                logger()->error('Failed to create storage symlink: ' . $e->getMessage());
            }
        }
    }
}