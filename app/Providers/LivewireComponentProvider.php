<?php

namespace App\Providers;

use App\Livewire\Admin\UsersTable;
use App\Livewire\Admin\DashboardStats;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireComponentProvider extends ServiceProvider
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
        Livewire::component('admin.users-table', UsersTable::class);
         Livewire::component('admin.dashboard-stats', DashboardStats::class);
    }
}