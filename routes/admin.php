<?php

use App\Http\Controllers\Admin\{
    AdminController,
    RuleController,
    NpcController,
    CharacterController,
    UserController,
    SettingsController,
    ExportController
};
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

// Admin Routes - All protected by auth and admin middleware
Route::middleware(['auth', EnsureUserIsAdmin::class])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
    
    // Users management
    Route::get('/users', [AdminController::class, 'usersList'])
        ->name('admin.users-list');
    
    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])
        ->name('admin.settings');
    
    // Rules Management
    Route::prefix('rules')->name('admin.rules.')->group(function () {
        Route::get('/', [RuleController::class, 'index'])->name('index');
        Route::get('/create', [RuleController::class, 'create'])->name('create');
        Route::post('/', [RuleController::class, 'store'])->name('store');
        Route::get('/{rule}/edit', [RuleController::class, 'edit'])->name('edit');
        Route::put('/{rule}', [RuleController::class, 'update'])->name('update');
        Route::delete('/{rule}', [RuleController::class, 'destroy'])->name('destroy');
    });
    
    // NPCs Management
    Route::prefix('npcs')->name('admin.npcs.')->group(function () {
        Route::get('/', [NpcController::class, 'index'])->name('index');
        Route::get('/create', [NpcController::class, 'create'])->name('create');
        Route::post('/', [NpcController::class, 'store'])->name('store');
        Route::get('/{npc}/edit', [NpcController::class, 'edit'])->name('edit');
        Route::put('/{npc}', [NpcController::class, 'update'])->name('update');
        Route::delete('/{npc}', [NpcController::class, 'destroy'])->name('destroy');
    });
    
    // Characters Management
    Route::prefix('characters')->name('admin.characters.')->group(function () {
        Route::get('/', [CharacterController::class, 'index'])->name('index');
        Route::get('/create', [CharacterController::class, 'create'])->name('create');
        Route::post('/', [CharacterController::class, 'store'])->name('store');
        Route::get('/{character}/edit', [CharacterController::class, 'edit'])->name('edit');
        Route::put('/{character}', [CharacterController::class, 'update'])->name('update');
        Route::delete('/{character}', [CharacterController::class, 'destroy'])->name('destroy');
    });
    
    // Users Management
    Route::prefix('user-management')->name('admin.users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });
    
    // Export Routes
    Route::prefix('export')->name('admin.export.')->group(function () {
        Route::get('/users/pdf', [ExportController::class, 'exportUsersPdf'])->name('users.pdf');
        Route::get('/users/excel', [ExportController::class, 'exportUsersExcel'])->name('users.excel');
        Route::get('/users/csv', [ExportController::class, 'exportUsersCsv'])->name('users.csv');
    });
});