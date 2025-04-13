<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\SocialiteServiceProvider as BaseSocialiteServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class SocialiteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->register(BaseSocialiteServiceProvider::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Configure Socialite drivers based on environment
        $this->configureSocialiteDrivers();
    }

    /**
     * Configure Socialite drivers dynamically
     */
    protected function configureSocialiteDrivers(): void
    {
        $socialLoginConfig = config('app.social_login');

        // Facebook Configuration
        if ($socialLoginConfig['facebook']['enabled']) {
            config([
                'services.facebook.client_id' => $socialLoginConfig['facebook']['client_id'],
                'services.facebook.client_secret' => $socialLoginConfig['facebook']['client_secret'],
                'services.facebook.redirect' => $socialLoginConfig['facebook']['redirect'],
            ]);
        }

        // Google Configuration
        if ($socialLoginConfig['google']['enabled']) {
            config([
                'services.google.client_id' => $socialLoginConfig['google']['client_id'],
                'services.google.client_secret' => $socialLoginConfig['google']['client_secret'],
                'services.google.redirect' => $socialLoginConfig['google']['redirect'],
            ]);
        }
    }
}