<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ApiDocsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind configuration
        $this->app->bind('api.docs.config', function () {
            return config('api-docs');
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publish configuration file
        $this->publishes([
            __DIR__.'/../../config/api-docs.php' => config_path('api-docs.php'),
        ], 'api-docs-config');
    }
}