<?php

use App\Http\Controllers\Admin\{
    RuleController,
    NpcController,
    CharacterController,
    UserController,
    SettingsController
};
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

// Admin Routes - All protected by auth and admin middleware
Route::middleware(['auth', EnsureUserIsAdmin::class])->group(function () {
    // Dashboard
    Route::get('/dashboard', fn() => view('pages.admin.dashboard'))
        ->name('admin.dashboard');
    
    // Rules Management
    Route::prefix('rules')->group(function () {
        Route::get('/', fn() => view('pages.admin.rules.index'))->name('admin.rules.index');
        Route::get('/create', fn() => view('pages.admin.rules.create'))->name('admin.rules.create');
        Route::get('/{rule}/edit', fn() => view('pages.admin.rules.edit'))->name('admin.rules.edit');
    });
    
    // NPCs Management
    Route::prefix('npcs')->group(function () {
        Route::get('/', fn() => view('pages.admin.npcs.index'))->name('admin.npcs.index');
        Route::get('/create', fn() => view('pages.admin.npcs.create'))->name('admin.npcs.create');
        Route::get('/{npc}/edit', fn() => view('pages.admin.npcs.edit'))->name('admin.npcs.edit');
    });
    
    // Characters Management
    Route::prefix('characters')->group(function () {
        Route::get('/', fn() => view('pages.admin.characters.index'))->name('admin.characters.index');
        Route::get('/create', fn() => view('pages.admin.characters.create'))->name('admin.characters.create');
        Route::get('/{character}/edit', fn() => view('pages.admin.characters.edit'))->name('admin.characters.edit');
    });
    
    // Users Management
    Route::prefix('users')->group(function () {
        Route::get('/', fn() => view('pages.admin.users.index'))->name('admin.users.index');
        Route::get('/{user}/edit', fn() => view('pages.admin.users.edit'))->name('admin.users.edit');
    });
    
    // Settings
    Route::get('/settings', fn() => view('pages.admin.settings'))->name('admin.settings');
});