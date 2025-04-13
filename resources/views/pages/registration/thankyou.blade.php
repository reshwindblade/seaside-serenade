<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('registration.thankyou');
middleware(['auth']);

new class extends Component
{
};

?>

<x-layouts.marketing>
    <div class="flex flex-col items-center justify-center max-w-4xl min-h-screen px-4 py-12 mx-auto">
        <div class="w-full p-8 text-center bg-white shadow-lg rounded-xl dark:bg-gray-900/60 dark:border-gray-800/60 dark:border">
            <div class="flex justify-center mb-6">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-green-100 dark:bg-green-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
            <h1 class="mb-4 text-3xl font-bold text-gray-800 dark:text-white">Registration Successful!</h1>
            <p class="mb-8 text-lg text-gray-600 dark:text-gray-300">
                Thank you for registering with us. Your account has been created successfully.
            </p>
            <div class="flex flex-col items-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4 justify-center">
                <x-ui.button type="primary" tag="a" href="{{ route('admin.dashboard') }}">
                    Go to Dashboard
                </x-ui.button>
                <x-ui.button type="secondary" tag="a" href="{{ route('home') }}">
                    Return to Home
                </x-ui.button>
            </div>
        </div>
    </div>
</x-layouts.marketing>