<?php

use App\Http\Controllers\Admin\ExportController;
use Illuminate\Support\Facades\Route;

// Admin Dashboard Routes
Route::get('/dashboard', fn() => view('pages.admin.dashboard'))
    ->name('admin.dashboard');

// User Management Routes
Route::get('/users', fn() => view('pages.admin.users-list'))
    ->name('admin.users-list');

// User Profile Route
Route::get('/users/{id}/edit', fn($id) => view('pages.admin.user-edit', ['id' => $id]))
    ->name('admin.users.edit');

// Admin Settings Route
Route::get('/settings', fn() => view('pages.admin.settings'))
    ->name('admin.settings');

// Export Routes
Route::prefix('exports')->group(function () {
    Route::get('/users/pdf', [ExportController::class, 'exportUsersPdf'])
        ->name('admin.exports.users.pdf');
    
    Route::get('/users/excel', [ExportController::class, 'exportUsersExcel'])
        ->name('admin.exports.users.excel');
    
    Route::get('/users/csv', [ExportController::class, 'exportUsersCsv'])
        ->name('admin.exports.users.csv');
});