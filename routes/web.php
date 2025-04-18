<?php

use App\Http\Controllers\Auth\{
    EmailVerificationController, 
    LogoutController, 
    PasswordResetLinkController
};
use App\Http\Controllers\MagicalGirlController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Livewire\Admin\DashboardStats;
use App\Livewire\Admin\UsersTable;
use App\Livewire\CharactersList;
use App\Livewire\NpcsList;
use App\Livewire\RulesList;
use App\Models\Character;
use App\Models\Npc;
use App\Models\Rule;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view('pages.index');
})->name('home');

// Frontend Content Routes
Route::get('/rules', function () {
    return view('pages.rules');
})->name('rules');

Route::get('/rules/{rule}', function (Rule $rule) {
    if (!$rule->is_active) {
        abort(404);
    }
    return view('pages.rules.show', compact('rule'));
})->name('rules.show');

Route::get('/npcs', function () {
    return view('pages.npcs');
})->name('npcs');

Route::get('/npcs/{npc}', function (Npc $npc) {
    if (!$npc->is_active) {
        abort(404);
    }
    return view('pages.npcs.show', compact('npc'));
})->name('npcs.show');

Route::get('/characters', function () {
    return view('pages.characters');
})->middleware(['auth', 'verified'])->name('characters');

Route::get('/characters/{character}', function (Character $character) {
    return view('pages.characters.show', compact('character'));
})->name('characters.show');

Route::get('/world-setting', function () {
    return view('pages.world');
})->name('world');

Route::get('/adventure-recaps', function () {
    return view('pages.recaps');
})->name('recaps');

Route::get('/powers-abilities', function () {
    return view('pages.powers');
})->name('powers');

// Magical Girl Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/magical-girl/create', [MagicalGirlController::class, 'create'])
        ->name('magical-girl.create');
    Route::post('/magical-girl', [MagicalGirlController::class, 'store'])
        ->name('magical-girl.store');
    Route::get('/magical-girl', [MagicalGirlController::class, 'show'])
        ->name('magical-girl.show');
    Route::get('/magical-girl/edit', [MagicalGirlController::class, 'edit'])
        ->name('magical-girl.edit');
    Route::put('/magical-girl', [MagicalGirlController::class, 'update'])
        ->name('magical-girl.update');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('/login', function () {
        return view('pages.auth.login');
    })->name('login');

    // Registration Route with Conditional Access
    Route::get('/register', function () {
        abort_if(config('app.disable_registration'), 403, 'New account registration is currently disabled.');
        return view('pages.auth.register');
    })->name('register');

    // Password Reset Routes
    Route::get('/forgot-password', function () {
        return view('pages.auth.password.request');
    })->name('password.request');

    Route::get('/reset-password/{token}', function ($token) {
        return view('pages.auth.password.reset', compact('token'));
    })->name('password.reset');
    
    Route::post('/password-email', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');
});

// Protected Authentication Routes
Route::middleware('auth')->group(function () {
    // Email Verification
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');
    
    Route::get('/email/verify', function () {
        return view('pages.auth.verify');
    })->middleware('throttle:6,1')->name('verification.notice');

    // Logout
    Route::post('logout', LogoutController::class)->name('logout');

    // Profile
    Route::get('/profile', function () {
        return view('pages.profile.edit');
    })->name('profile.edit');
    
    // Registration Confirmation
    Route::get('/registration/thankyou', function () {
        return view('pages.registration.thankyou');
    })->name('registration.thankyou');
    
    // Password Confirm
    Route::get('/confirm-password', function() {
        return view('pages.auth.password.confirm');
    })->name('password.confirm');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'verified', EnsureUserIsAdmin::class])->group(function () {
    Route::get('/dashboard', function() {
        return view('pages.admin.dashboard');
    })->name('admin.dashboard');
    
    Route::get('/users-list', function() {
        return view('pages.admin.users-list');
    })->name('admin.users-list');
    
    Route::get('/settings', function() {
        return view('pages.admin.setting');
    })->name('admin.settings');
});