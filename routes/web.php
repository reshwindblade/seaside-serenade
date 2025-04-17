<?php

use App\Http\Controllers\Auth\{
    EmailVerificationController, 
    LogoutController, 
};
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Controllers\MagicalGirlController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', fn() => view('pages.index'))->name('home');

// Frontend Content Routes
Route::get('/rules', fn() => view('pages.rules'))->name('rules');
Route::get('/rules/{rule}', fn() => view('pages.rules.show'))->name('rules.show');

Route::get('/npcs', fn() => view('pages.npcs'))->name('npcs');
Route::get('/npcs/{npc}', fn() => view('pages.npcs.show'))->name('npcs.show');

Route::get('/characters', fn() => view('pages.characters'))->name('characters');
Route::get('/characters/{character}', fn() => view('pages.characters.show'))->name('characters.show');

Route::get('/world-setting', fn() => view('pages.world'))->name('world');
Route::get('/adventure-recaps', fn() => view('pages.recaps'))->name('recaps');
Route::get('/powers-abilities', fn() => view('pages.powers'))->name('powers');

// Authentication Routes
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('/login', fn() => view('pages.auth.login'))
        ->name('login');

    // Registration Route with Conditional Access
    Route::get('/register', function () {
        abort_if(config('app.disable_registration'), 403, 'New account registration is currently disabled.');
        return view('pages.auth.register');
    })->name('register');

    // Password Reset Routes
    Route::get('/forgot-password', fn() => view('pages.auth.password.request'))
        ->name('password.request');

    Route::get('/reset-password/{token}', fn() => view('pages.auth.password.reset'))
        ->name('password.reset');
});

// Protected Authentication Routes
Route::middleware('auth')->group(function () {
    // Email Verification
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    // Logout
    Route::post('logout', LogoutController::class)->name('logout');

    // Profile
    Route::get('/profile', fn() => view('pages.profile.edit'))
        ->name('profile.edit');
    
    // Registration Confirmation
    Route::get('/registration/thankyou', fn() => view('pages.registration.thankyou'))
        ->name('registration.thankyou');
});


// Magical Girl Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Routes that require user to have a magical girl
    Route::middleware(['has.magical.girl'])->group(function () {
        Route::get('/magical-girl', [MagicalGirlController::class, 'show'])->name('magical-girl.show');
        Route::get('/magical-girl/edit', [MagicalGirlController::class, 'edit'])->name('magical-girl.edit');
        Route::put('/magical-girl', [MagicalGirlController::class, 'update'])->name('magical-girl.update');
    });
    
    // Routes that redirect if user already has a magical girl
    Route::middleware(['redirect.if.has.magical.girl'])->group(function () {
        Route::get('/magical-girl/create', [MagicalGirlController::class, 'create'])->name('magical-girl.create');
        Route::post('/magical-girl', [MagicalGirlController::class, 'store'])->name('magical-girl.store');
    });
});