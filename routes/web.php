<?php

use App\Http\Controllers\Auth\{
    EmailVerificationController, 
    LogoutController, 
    PasswordResetLinkController,
};
use App\Http\Controllers\MagicalGirlController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\NpcController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\WorldController;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\RecapController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Frontend Content Routes
Route::get('/rules', [RuleController::class, 'index'])->name('rules');
Route::get('/rules/{rule}', [RuleController::class, 'show'])->name('rules.show');

Route::get('/npcs', [NpcController::class, 'index'])->name('npcs');
Route::get('/npcs/{npc}', [NpcController::class, 'show'])->name('npcs.show');

Route::get('/characters', [CharacterController::class, 'index'])->middleware(['auth', 'verified'])->name('characters');
Route::get('/characters/{character}', [CharacterController::class, 'show'])->name('characters.show');

Route::get('/world-setting', [WorldController::class, 'index'])->name('world');
Route::get('/adventure-recaps', [RecapController::class, 'index'])->name('recaps');
Route::get('/powers-abilities', [PowerController::class, 'index'])->name('powers');

// Authentication Routes
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

    // Registration Route with Conditional Access
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

    // Password Reset Routes
    Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
});

// Protected Authentication Routes
Route::middleware('auth')->group(function () {
    // Email Verification
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');
    
    Route::get('/email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])
        ->middleware('throttle:6,1')
        ->name('verification.notice');
    
    Route::post('/email/verification-notification', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Logout
    Route::post('logout', LogoutController::class)->name('logout');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Registration Confirmation
    Route::get('/registration/thankyou', [App\Http\Controllers\Auth\RegisterController::class, 'thankYou'])
        ->name('registration.thankyou');
    
    // Password Confirm
    Route::get('/confirm-password', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'showConfirmForm'])
        ->name('password.confirm');
    Route::post('/confirm-password', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'confirm']);
    
    // Magical Girl Routes
    Route::prefix('magical-girl')->name('magical-girl.')->group(function () {
        Route::get('/create', [MagicalGirlController::class, 'create'])
            ->middleware('redirect.if.has.magical.girl')
            ->name('create');
        Route::post('/store', [MagicalGirlController::class, 'store'])->name('store');
        Route::get('/show', [MagicalGirlController::class, 'show'])
            ->middleware('ensure.has.magical.girl')
            ->name('show');
        Route::get('/edit', [MagicalGirlController::class, 'edit'])
            ->middleware('ensure.has.magical.girl')
            ->name('edit');
        Route::put('/update', [MagicalGirlController::class, 'update'])->name('update');
    });
});