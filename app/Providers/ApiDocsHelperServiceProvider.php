<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\ApiDocsHelper;

class ApiDocsHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('api.docs.helper', function () {
            return new ApiDocsHelper();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // If you want to add any global configurations or publish helper files
    }
}