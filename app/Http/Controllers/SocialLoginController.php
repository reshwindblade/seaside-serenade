<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialLoginController extends Controller
{
    /**
     * Redirect to the specified provider's OAuth page
     */
    public function redirectToProvider($provider)
    {
        // Check if social login is enabled
        if (!config("app.social_login.{$provider}.enabled")) {
            abort(403, 'Social login is not enabled');
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle callback from social login providers
     */
    public function handleProviderCallback($provider)
    {
        // Check if social login is enabled
        if (!config("app.social_login.{$provider}.enabled")) {
            abort(403, 'Social login is not enabled');
        }

        // Check if new account creation is disabled
        if (config('app.social_login.disable_registration')) {
            abort(403, 'New account registration is currently disabled');
        }

        try {
            // Get user details from the provider
            $socialUser = Socialite::driver($provider)->user();

            // Find or create user based on provider details
            $user = User::firstOrCreate(
                [
                    'email' => $socialUser->getEmail()
                ],
                [
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'password' => bcrypt(Str::random(40)), // Random password for social login
                    'avatar' => $socialUser->getAvatar()
                ]
            );

            // Update provider details if already exists
            if ($user->wasRecentlyCreated === false && $user->provider !== $provider) {
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar()
                ]);
            }

            // Log in the user
            Auth::login($user, true);

            // Redirect to dashboard or intended page
            return redirect()->intended(route('admin.dashboard'));

        } catch (\Exception $e) {
            // Log the error and redirect back with an error message
            \Log::error('Social Login Error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Unable to login with ' . ucfirst($provider));
        }
    }
}