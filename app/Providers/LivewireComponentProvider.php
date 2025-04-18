<?php

namespace App\Providers;

use App\Livewire\Admin\UsersTable;
use App\Livewire\Admin\DashboardStats;
use App\Livewire\Admin\Settings;
use App\Livewire\Auth\VerificationNotice;
use App\Livewire\CharactersList;
use App\Livewire\NpcsList;
use App\Livewire\RulesList;
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
        // Admin Components
        Livewire::component('admin.users-table', UsersTable::class);
        Livewire::component('admin.dashboard-stats', DashboardStats::class);
        Livewire::component('admin.settings', Settings::class);
        
        // Auth Components
        Livewire::component('auth.verification-notice', VerificationNotice::class);
        
        // Frontend Components
        Livewire::component('characters-list', CharactersList::class);
        Livewire::component('npcs-list', NpcsList::class);
        Livewire::component('rules-list', RulesList::class);
    }
}