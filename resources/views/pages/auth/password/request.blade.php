<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

name('password.request');
middleware(['guest']);

new class extends Component
{
    #[Validate('required|email')]
    public $email = '';

    public function sendResetLink()
    {
        $this->validate();

        $status = \Illuminate\Support\Facades\Password::sendResetLink(
            ['email' => $this->email]
        );

        if ($status == \Illuminate\Support\Facades\Password::RESET_LINK_SENT) {
            $this->dispatch('toast', message: 'Password reset link sent', data: ['type' => 'success', 'position' => 'top-right']);
            $this->reset('email');
            return;
        }

        $this->addError('email', trans($status));
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
                Enter your email and we'll send you a reset link
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-8 py-10 bg-white shadow-2xl dark:bg-gray-800/60 sm:rounded-xl border border-gray-200 dark:border-gray-700/50">
                @volt('auth.password.request')
                <form wire:submit="sendResetLink" class="space-y-6">
                    <x-ui.input 
                        label="Email address" 
                        type="email" 
                        id="email" 
                        name="email" 
                        wire:model="email"
                        placeholder="you@example.com"
                        class="transition-all duration-300 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400"
                    />

                    <x-ui.button 
                        type="primary" 
                        rounded="md" 
                        submit="true" 
                        class="w-full mt-6 transition-all duration-300 ease-in-out transform hover:scale-[1.02] active:scale-[0.98]"
                    >
                        Send Reset Link
                    </x-ui.button>

                    <div class="text-center mt-4">
                        <x-ui.text-link href="{{ route('login') }}">
                            Back to login
                        </x-ui.text-link>
                    </div>
                </form>
                @endvolt
            </div>
        </div>
    </div>
</x-layouts.main>