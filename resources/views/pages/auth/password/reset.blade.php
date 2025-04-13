<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

use function Laravel\Folio\name;

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

name('password.reset');

new class extends Component
{
    #[Validate('required')]
    public $token;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|min:8|confirmed')]
    public $password;

    #[Validate('required|min:8')]
    public $password_confirmation;

    public function mount($token)
    {
        $this->email = request()->query('email', '');
        $this->token = $token;
    }

    public function resetPassword()
    {
        $this->validate();

        $response = Password::broker()->reset(
            [
                'token' => $this->token,
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
            ],
            function ($user, $password) {
                $user->password = Hash::make($password);

                $user->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));

                Auth::guard()->login($user);
            },
        );

        if ($response == Password::PASSWORD_RESET) {
            session()->flash(trans($response));

            return redirect('/');
        }

        $this->addError('email', trans($response));
    }
};

?>

<x-layouts.main>
    <div class="flex flex-col items-stretch justify-center w-screen min-h-screen py-10 sm:items-center bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-950">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="flex justify-center mb-6">
                <x-ui.logo class="w-auto h-12 text-gray-800 fill-current dark:text-white" />
            </div>
            <h2 class="mt-2 text-3xl font-extrabold leading-9 text-center text-gray-900 dark:text-white">
                Reset your password
            </h2>
            <p class="mt-2 text-sm text-center text-gray-600 dark:text-gray-400">
                Enter your new password below
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-8 py-10 bg-white shadow-2xl dark:bg-gray-800/60 sm:rounded-xl border border-gray-200 dark:border-gray-700/50">
                @volt('auth.password.token')
                <form wire:submit="resetPassword" class="space-y-6">
                    <x-ui.input 
                        label="Email address" 
                        type="email" 
                        id="email" 
                        name="email" 
                        wire:model="email"
                        placeholder="you@example.com"
                        class="transition-all duration-300 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400"
                    />
                    <x-ui.input 
                        label="New Password" 
                        type="password" 
                        id="password" 
                        name="password" 
                        wire:model="password"
                        placeholder="Enter new password"
                        class="transition-all duration-300 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400"
                    />
                    <x-ui.input 
                        label="Confirm New Password" 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        wire:model="password_confirmation"
                        placeholder="Confirm new password"
                        class="transition-all duration-300 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400"
                    />

                    <x-ui.button 
                        type="primary" 
                        rounded="md" 
                        submit="true" 
                        class="w-full mt-6 transition-all duration-300 ease-in-out transform hover:scale-[1.02] active:scale-[0.98]"
                    >
                        Reset Password
                    </x-ui.button>
                </form>
                @endvolt
            </div>
        </div>
    </div>
</x-layouts.main>