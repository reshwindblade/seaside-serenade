<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('home');
middleware(['redirect-to-dashboard']);

new class extends Component
{
    public $registrationDisabled;

    public function mount()
    {
        $this->registrationDisabled = config('app.disable_registration');
    }
};

?>

<x-layouts.marketing>
    @volt('home')
    <div class="flex flex-col items-center justify-center min-h-screen px-4 py-12 
        bg-gradient-to-b from-white to-gray-100 
        dark:from-gray-900 dark:to-gray-800 
        dark:text-gray-100">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="mb-6 text-4xl font-bold tracking-tight 
                text-gray-900 dark:text-white">
                Community Portal
            </h1>
            <p class="mb-10 text-lg 
                text-gray-600 dark:text-gray-300">
                {{ $registrationDisabled 
                    ? 'Login to access our community features.' 
                    : 'Create an account to join our community. Sign up today to access exclusive features and content.' 
                }}
            </p>
            
            <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
                @if(!$registrationDisabled)
                    <x-ui.button type="primary" tag="a" href="{{ route('register') }}" class="px-6 py-3">
                        Register Now
                    </x-ui.button>
                @endif
                <x-ui.button 
                    type="{{ $registrationDisabled ? 'primary' : 'secondary' }}" 
                    tag="a" 
                    href="{{ route('login') }}" 
                    class="px-6 py-3"
                >
                    Sign In
                </x-ui.button>
            </div>
        </div>
    </div>
    @endvolt
</x-layouts.marketing>