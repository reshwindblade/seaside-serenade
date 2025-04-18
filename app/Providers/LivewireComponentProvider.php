<?php

namespace App\Providers;

use App\Livewire\Auth\Login;
use App\Livewire\Admin\DashboardStats;
use App\Livewire\Admin\UsersTable;
use App\Livewire\CharactersList;
use App\Livewire\NpcsList;
use App\Livewire\Profile\Edit as ProfileEdit;
use App\Livewire\RulesList;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Auth components
        Livewire::component('auth.login', Login::class);
        
        // Admin components
        Livewire::component('admin.dashboard-stats', DashboardStats::class);
        Livewire::component('admin.users-table', UsersTable::class);
        
        // User profile components
        Livewire::component('profile.edit', ProfileEdit::class);
        
        // Content components
        Livewire::component('rules-list', RulesList::class);
        Livewire::component('npcs-list', NpcsList::class);
        Livewire::component('characters-list', CharactersList::class);
    }
}