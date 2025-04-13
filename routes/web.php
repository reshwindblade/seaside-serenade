<?php

use App\Http\Controllers\Auth\{
    EmailVerificationController, 
    LogoutController, 
    SocialLoginController
};
use Illuminate\Support\Facades\Route;

// Redirects and Home Routes
Route::redirect('home', '/')->name('home');


// Authentication Routes
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('/login', fn() => view('pages.auth.login'))
        ->name('login');

    // Social Login Routes
    Route::get('/login/{provider}', [SocialLoginController::class, 'redirectToProvider'])
        ->name('login.social')
        ->where('provider', 'facebook|google');

    Route::get('/login/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback'])
        ->name('login.social.callback')
        ->where('provider', 'facebook|google');

    // Registration Route with Conditional Access
    Route::get('/register', function () {
        abort_if(config('app.disable_registration'), 403, 'New account registration is currently disabled.');
        return view('pages.auth.register');
    })->name('register');

    // Password Reset Routes
    Route::get('/forgot-password', fn() => view('pages.auth.password.request'))
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');
});

// Protected Authentication Routes
Route::middleware('auth')->group(function () {
    // Email Verification
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    // Logout
    Route::post('logout', LogoutController::class)->name('logout');

    // Registration Confirmation
    Route::get('/registration/thankyou', fn() => view('pages.registration.thankyou'))
        ->name('registration.thankyou');
});

// Public Information Routes
Route::get('/api/docs', fn() => view('pages.api-docs'))
    ->name('api.docs');