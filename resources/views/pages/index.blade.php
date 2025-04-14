<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('home');
middleware(['redirect-to-dashboard']);

new class extends Component
{
    public $registrationDisabled;
    public $features = [];

    public function mount()
    {
        $this->registrationDisabled = config('app.disable_registration');
        $this->features = [
            [
                'title' => 'User Management',
                'description' => 'Easily manage user accounts and permissions with our intuitive admin dashboard.',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>'
            ],
            [
                'title' => 'API Access',
                'description' => 'Access all features programmatically through our comprehensive RESTful API.',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>'
            ],
            [
                'title' => 'Analytics Dashboard',
                'description' => 'Get valuable insights with real-time data visualization and reporting tools.',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>'
            ]
        ];
    }
};

?>

<x-layouts.marketing>
    @volt('home')
    <div>
        <!-- Hero Section -->
        <div class="relative px-4 pt-16 pb-20 overflow-hidden bg-gradient-to-b from-white to-gray-100 dark:from-gray-900 dark:to-gray-800 sm:px-6 lg:px-8 lg:pt-24 lg:pb-28">
            <div class="relative max-w-6xl mx-auto">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                        <span class="block">Welcome to our</span>
                        <span class="block text-blue-600 dark:text-blue-400">Community Portal</span>
                    </h1>
                    <p class="max-w-2xl mx-auto mt-6 text-xl text-gray-600 dark:text-gray-300">
                        {{ $registrationDisabled 
                            ? 'Login to access our community features and resources.' 
                            : 'Create an account to join our community. Sign up today to access exclusive features and content.' 
                        }}
                    </p>
                    <div class="flex flex-col items-center justify-center max-w-md mx-auto mt-10 gap-4 sm:flex-row">
                        @if(!$registrationDisabled)
                            <x-ui.button type="primary" tag="a" href="{{ route('register') }}" class="px-8 py-3 text-base font-medium">
                                Register Now
                            </x-ui.button>
                        @endif
                        <x-ui.button 
                            type="{{ $registrationDisabled ? 'primary' : 'secondary' }}" 
                            tag="a" 
                            href="{{ route('login') }}" 
                            class="px-8 py-3 text-base font-medium"
                        >
                            Sign In
                        </x-ui.button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-16 bg-white dark:bg-gray-900 sm:py-24">
            <div class="max-w-6xl px-4 mx-auto sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                        Key Features
                    </h2>
                    <p class="max-w-2xl mx-auto mt-4 text-xl text-gray-600 dark:text-gray-300">
                        Everything you need to manage your community effectively
                    </p>
                </div>

                <div class="mt-12">
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($features as $feature)
                            <div class="pt-6">
                                <div class="flow-root px-6 pb-8 rounded-lg bg-gray-50 dark:bg-gray-800">
                                    <div class="-mt-6">
                                        <div>
                                            <span class="inline-flex items-center justify-center p-3 rounded-md shadow-lg bg-blue-600 dark:bg-blue-500">
                                                {!! $feature['icon'] !!}
                                            </span>
                                        </div>
                                        <h3 class="mt-8 text-lg font-medium tracking-tight text-gray-900 dark:text-white">
                                            {{ $feature['title'] }}
                                        </h3>
                                        <p class="mt-5 text-base text-gray-500 dark:text-gray-400">
                                            {{ $feature['description'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-blue-600 dark:bg-blue-700">
            <div class="max-w-5xl px-4 py-16 mx-auto sm:px-6 lg:px-8 lg:py-20">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                        Ready to get started?
                    </h2>
                    <p class="max-w-2xl mx-auto mt-4 text-lg text-blue-100">
                        Join our community today and experience all the benefits our platform has to offer.
                    </p>
                    <div class="flex justify-center mt-8">
                        @if(!$registrationDisabled)
                            <x-ui.button type="secondary" tag="a" href="{{ route('register') }}" class="px-8 py-3 text-base font-medium">
                                Register Now
                            </x-ui.button>
                        @else
                            <x-ui.button type="secondary" tag="a" href="{{ route('login') }}" class="px-8 py-3 text-base font-medium">
                                Sign In
                            </x-ui.button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endvolt
</x-layouts.marketing>