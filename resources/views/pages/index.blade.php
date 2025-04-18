<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('home');
middleware(['redirect-to-dashboard']);

new class extends Component
{
    public $registrationDisabled;
    public $userHasMagicalGirl;

    public function mount()
    {
        $this->registrationDisabled = config('app.disable_registration');
        $this->userHasMagicalGirl = auth()->check() && auth()->user()->hasMagicalGirl();
    }
};

?>

<x-layouts.magical-ocean>
    @volt('home')
    <div>
        {{-- Main Navigation --}}
        <x-ui.magical.header />
    
        {{-- Hero Section --}}
        <section class="relative min-h-screen flex items-center justify-center px-4 py-20">
            {{-- Hero Background Elements --}}
            <div class="absolute inset-0 z-0">
                <div class="absolute top-20 left-10 w-64 h-64 rounded-full bg-blue-500/10 dark:bg-blue-500/5 blur-3xl"></div>
                <div class="absolute bottom-20 right-10 w-96 h-96 rounded-full bg-purple-500/10 dark:bg-purple-500/5 blur-3xl"></div>
                <div class="absolute top-1/2 left-1/3 w-72 h-72 rounded-full bg-cyan-500/10 dark:bg-cyan-500/5 blur-3xl"></div>
            </div>
            
            <div class="container max-w-6xl mx-auto z-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    {{-- Hero Content --}}
                    <div 
                        x-data="{show: false}" 
                        x-init="setTimeout(() => show = true, 100)" 
                        class="text-center lg:text-left"
                    >
                        <h1 
                            x-show="show"
                            x-transition:enter="transition ease-out duration-700 transform"
                            x-transition:enter-start="opacity-0 translate-y-12"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-indigo-500 to-purple-600 dark:from-blue-400 dark:via-indigo-300 dark:to-purple-400"
                        >
                            Magical Ocean Portal
                        </h1>
                        
                        <p 
                            x-show="show"
                            x-transition:enter="transition ease-out delay-300 duration-700 transform"
                            x-transition:enter-start="opacity-0 translate-y-12"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="text-lg md:text-xl text-blue-950 dark:text-blue-100 mb-10 max-w-xl mx-auto lg:mx-0"
                        >
                            {{ $registrationDisabled 
                                ? 'Dive into our magical ocean community. Login to access exclusive features and content.' 
                                : 'Create an account to join our magical ocean community. Sign up today to dive into exclusive features and content.' 
                            }}
                        </p>
                        
                        <div 
                            x-show="show"
                            x-transition:enter="transition ease-out delay-500 duration-700 transform"
                            x-transition:enter-start="opacity-0 translate-y-12"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 mt-8"
                        >
                            @auth
                                @if(!$userHasMagicalGirl)
                                    <a href="{{ route('magical-girl.create') }}" class="relative overflow-hidden group inline-flex items-center px-8 py-3.5 font-medium text-base rounded-full text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/30 dark:hover:shadow-blue-700/30 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 w-full sm:w-auto justify-center">
                                        <span class="relative z-10">Create Magical Girl</span>
                                        <span class="absolute inset-0 overflow-hidden rounded-full">
                                            <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-80"></span>
                                        </span>
                                    </a>
                                @else
                                    <a href="{{ route('magical-girl.show') }}" class="relative overflow-hidden group inline-flex items-center px-8 py-3.5 font-medium text-base rounded-full text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/30 dark:hover:shadow-blue-700/30 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 w-full sm:w-auto justify-center">
                                        <span class="relative z-10">View Magical Girl</span>
                                        <span class="absolute inset-0 overflow-hidden rounded-full">
                                            <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-80"></span>
                                        </span>
                                    </a>
                                @endif
                            @else
                                @if(!$registrationDisabled)
                                    <a href="{{ route('register') }}" class="relative overflow-hidden group inline-flex items-center px-8 py-3.5 font-medium text-base rounded-full text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/30 dark:hover:shadow-blue-700/30 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 w-full sm:w-auto justify-center">
                                        <span class="relative z-10">Register Now</span>
                                        <span class="absolute inset-0 overflow-hidden rounded-full">
                                            <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-80"></span>
                                        </span>
                                    </a>
                                @endif
                                
                                <a href="{{ route('login') }}" class="relative overflow-hidden group inline-flex items-center px-8 py-3.5 font-medium text-base rounded-full text-blue-600 dark:text-blue-300 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 border border-blue-200 dark:border-blue-800 hover:border-blue-300 dark:hover:border-blue-700 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 w-full sm:w-auto justify-center">
                                    <span class="relative z-10">{{ $registrationDisabled ? 'Sign In' : 'Login to Account' }}</span>
                                    <span class="absolute inset-0 overflow-hidden rounded-full">
                                        <span class="absolute -left-10 w-20 h-full bg-blue-100/50 dark:bg-blue-900/30 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-60"></span>
                                    </span>
                                </a>
                            @endauth
                        </div>
                    </div>
                    
                    {{-- Hero Illustration --}}
                    <div 
                        x-data="{show: false}" 
                        x-init="setTimeout(() => show = true, 700)" 
                        class="relative"
                    >
                        <div 
                            x-show="show"
                            x-transition:enter="transition ease-out duration-1000 transform"
                            x-transition:enter-start="opacity-0 translate-y-12 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            class="relative z-10"
                        >
                            <!-- SVG Illustration Remains the Same as in Previous Implementation -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Portal Features Section -->
        <section class="py-20 px-4 bg-white dark:bg-gray-900">
            <div class="container max-w-6xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-16 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">
                    Portal Features
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Rules -->
                    <a href="{{ route('rules') }}" class="magical-card flex flex-col h-full hover:scale-105 transition-transform duration-300">
                        <div class="p-6">
                            <div class="mb-4 w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-3 text-blue-900 dark:text-blue-100">Game Rules</h3>
                            <p class="text-blue-800/70 dark:text-blue-200/70">Explore the comprehensive rules and guidelines for our magical world.</p>
                        </div>
                    </a>
                    
                    <!-- Characters -->
                    <a href="{{ route('characters') }}" class="magical-card flex flex-col h-full hover:scale-105 transition-transform duration-300">
                        <div class="p-6">
                            <div class="mb-4 w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-3 text-blue-900 dark:text-blue-100">Player Characters</h3>
                            <p class="text-blue-800/70 dark:text-blue-200/70">Browse and explore player-created magical girl characters.</p>
                        </div>
                    </a>
                    
                    <!-- NPCs -->
                    <a href="{{ route('npcs') }}" class="magical-card flex flex-col h-full hover:scale-105 transition-transform duration-300">
                        <div class="p-6">
                            <div class="mb-4 w-16 h-16 bg-pink-100 dark:bg-pink-900/30 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pink-600 dark:text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-3 text-blue-900 dark:text-blue-100">NPCs</h3>
                            <p class="text-blue-800/70 dark:text-blue-200/70">Discover the non-player characters of our magical world.</p>
                        </div>
                    </a>
                    
                    <!-- World Setting -->
                    <a href="{{ route('world') }}" class="magical-card flex flex-col h-full hover:scale-105 transition-transform duration-300">
                        <div class="p-6">
                            <div class="mb-4 w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.