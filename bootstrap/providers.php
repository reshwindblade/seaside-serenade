<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Add your own services to the list to
    | grant expanded functionality to your applications.
    |
    */
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    // App\Providers\BroadcastServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
    App\Providers\FolioServiceProvider::class,
    App\Providers\VoltServiceProvider::class,
    App\Providers\LivewireComponentProvider::class,
    App\Providers\CyberpunkServiceProvider::class, // Add our custom provider here
];