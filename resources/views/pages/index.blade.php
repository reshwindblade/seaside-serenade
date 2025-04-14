{{-- resources/views/pages/index.blade.php --}}
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
                            @if(!$registrationDisabled)
                                <a href="{{ route('register') }}" class="relative overflow-hidden group inline-flex items-center px-8 py-3.5 font-medium text-base rounded-full text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/30 dark:hover:shadow-blue-700/30 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 w-full sm:w-auto justify-center">
                                    <span class="relative z-10">Register Now</span>
                                    <span class="absolute inset-0 overflow-hidden rounded-full">
                                        <span class="absolute inset-0 rounded-full bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                                        <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-60"></span>
                                    </span>
                                </a>
                            @endif
                            
                            <a href="{{ route('login') }}" class="relative overflow-hidden group inline-flex items-center px-8 py-3.5 font-medium text-base rounded-full text-blue-600 dark:text-blue-300 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 border border-blue-200 dark:border-blue-800 hover:border-blue-300 dark:hover:border-blue-700 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 w-full sm:w-auto justify-center">
                                <span class="relative z-10">{{ $registrationDisabled ? 'Sign In' : 'Login to Account' }}</span>
                                <span class="absolute inset-0 overflow-hidden rounded-full">
                                    <span class="absolute -left-10 w-20 h-full bg-blue-100/50 dark:bg-blue-900/30 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-60"></span>
                                </span>
                            </a>
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
                            <div class="magical-card rounded-2xl p-1 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500">
                                <div class="bg-white dark:bg-gray-900 rounded-xl p-8 relative overflow-hidden">
                                    {{-- SVG Illustration: Magical Ocean --}}
                                    <svg class="w-full h-auto" viewBox="0 0 600 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <!-- Ocean Background -->
                                        <rect width="600" height="400" rx="16" fill="url(#ocean-gradient)" />
                                        
                                        <!-- Ocean Waves -->
                                        <path d="M0 300C50 280 100 320 150 300C200 280 250 260 300 280C350 300 400 320 450 300C500 280 550 260 600 280V400H0V300Z" fill="#1a91ff" fill-opacity="0.3" />
                                        <path d="M0 330C50 310 100 350 150 330C200 310 250 290 300 310C350 330 400 350 450 330C500 310 550 290 600 310V400H0V330Z" fill="#00e2c3" fill-opacity="0.2" />
                                        
                                        <!-- Magical Girl -->
                                        <g class="floating" style="animation-delay: 0.5s;">
                                            <ellipse cx="300" cy="200" rx="60" ry="80" fill="url(#aura-gradient)" fill-opacity="0.6" />
                                            <path d="M270 160C270 160 290 180 300 160C310 140 330 160 330 160" stroke="#ff5995" stroke-width="4" stroke-linecap="round" />
                                            <circle cx="300" cy="200" r="30" fill="#5643fd" />
                                            <path d="M285 190C285 190 295 205 315 190" stroke="white" stroke-width="2" stroke-linecap="round" />
                                        </g>
                                        
                                        <!-- Bubbles -->
                                        <circle class="floating" cx="350" cy="150" r="15" fill="white" fill-opacity="0.5" style="animation-delay: 0.2s;" />
                                        <circle class="floating" cx="380" cy="220" r="10" fill="white" fill-opacity="0.4" style="animation-delay: 0.7s;" />
                                        <circle class="floating" cx="250" cy="180" r="12" fill="white" fill-opacity="0.4" style="animation-delay: 1.1s;" />
                                        <circle class="floating" cx="220" cy="240" r="8" fill="white" fill-opacity="0.3" style="animation-delay: 0.5s;" />
                                        
                                        <!-- Magical Stars -->
                                        <path class="shimmer" d="M400 100L405 110L415 115L405 120L400 130L395 120L385 115L395 110L400 100Z" fill="#ff5995" />
                                        <path class="shimmer" d="M200 120L203 126L210 129L203 132L200 138L197 132L190 129L197 126L200 120Z" fill="#00e2c3" />
                                        <path class="shimmer" d="M480 200L483 206L490 209L483 212L480 218L477 212L470 209L477 206L480 200Z" fill="#b54aff" />
                                        <path class="shimmer" d="M150 220L153 226L160 229L153 232L150 238L147 232L140 229L147 226L150 220Z" fill="#1a91ff" />
                                        
                                        <!-- Gradient Definitions -->
                                        <defs>
                                            <linearGradient id="ocean-gradient" x1="0" y1="0" x2="600" y2="400" gradientUnits="userSpaceOnUse">
                                                <stop offset="0%" stop-color="#0a2463" />
                                                <stop offset="100%" stop-color="#1a91ff" />
                                            </linearGradient>
                                            <radialGradient id="aura-gradient" cx="300" cy="200" r="70" gradientUnits="userSpaceOnUse">
                                                <stop offset="0%" stop-color="#ff5995" />
                                                <stop offset="100%" stop-color="#b54aff" stop-opacity="0" />
                                            </radialGradient>
                                        </defs>
                                    </svg>
                                    
                                    <!-- Animated Elements -->
                                    <div class="absolute top-1/4 left-1/4 w-4 h-4 rounded-full bg-blue-400/50 dark:bg-blue-400/30 blur-sm floating" style="animation-delay: 0.3s;"></div>
                                    <div class="absolute top-1/3 right-1/3 w-6 h-6 rounded-full bg-purple-400/50 dark:bg-purple-400/30 blur-sm floating" style="animation-delay: 0.8s;"></div>
                                    <div class="absolute bottom-1/4 right-1/4 w-5 h-5 rounded-full bg-cyan-400/50 dark:bg-cyan-400/30 blur-sm floating" style="animation-delay: 1.3s;"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Decorative Background Shapes -->
                        <div class="absolute -bottom-10 -right-10 w-40 h-40 rounded-full bg-blue-500/10 dark:bg-blue-500/5 blur-xl"></div>
                        <div class="absolute -top-10 -left-10 w-40 h-40 rounded-full bg-purple-500/10 dark:bg-purple-500/5 blur-xl"></div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Features Section -->
        <section id="features" class="py-20 px-4">
            <div class="container max-w-6xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-16 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">
                    Magical Features
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="group relative p-1 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl transition-transform duration-300 hover:scale-105">
                        <div class="bg-white dark:bg-gray-900 p-8 rounded-xl h-full">
                            <div class="w-14 h-14 mb-6 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-3 text-blue-950 dark:text-blue-100">Magical Experience</h3>
                            <p class="text-blue-800/70 dark:text-blue-200/70">Dive into an enchanting underwater adventure with magical experiences at every turn.</p>
                        </div>
                    </div>
                    
                    <!-- Feature 2 -->
                    <div class="group relative p-1 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl transition-transform duration-300 hover:scale-105">
                        <div class="bg-white dark:bg-gray-900 p-8 rounded-xl h-full">
                            <div class="w-14 h-14 mb-6 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400 group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-3 text-blue-950 dark:text-blue-100">Secure Portal</h3>
                            <p class="text-blue-800/70 dark:text-blue-200/70">Your data is protected by advanced security measures and magical encryption.</p>
                        </div>
                    </div>
                    
                    <!-- Feature 3 -->
                    <div class="group relative p-1 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-2xl transition-transform duration-300 hover:scale-105">
                        <div class="bg-white dark:bg-gray-900 p-8 rounded-xl h-full">
                            <div class="w-14 h-14 mb-6 rounded-full bg-cyan-100 dark:bg-cyan-900/30 flex items-center justify-center text-cyan-600 dark:text-cyan-400 group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-3 text-blue-950 dark:text-blue-100">Ocean Power</h3>
                            <p class="text-blue-800/70 dark:text-blue-200/70">Harness the power of the magical ocean to transform your experience.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- About Section -->
        <section id="about" class="py-20 px-4 relative overflow-hidden">
            <div class="absolute inset-0 z-0">
                <div class="absolute top-20 left-10 w-64 h-64 rounded-full bg-blue-500/5 dark:bg-blue-500/3 blur-3xl"></div>
                <div class="absolute bottom-20 right-10 w-96 h-96 rounded-full bg-purple-500/5 dark:bg-purple-500/3 blur-3xl"></div>
            </div>
            
            <div class="container max-w-6xl mx-auto relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="order-2 lg:order-1">
                        <h2 class="text-3xl md:text-4xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">
                            About Our Magical Ocean
                        </h2>
                        
                        <p class="text-lg text-blue-950 dark:text-blue-100 mb-6">
                            Dive into a world where magic meets the ocean, creating a unique digital experience unlike any other.
                        </p>
                        
                        <p class="text-blue-800/70 dark:text-blue-200/70 mb-8">
                            Our portal combines the mystical elements of magical girls with the tranquil beauty of ocean themes, delivering a seamless and enchanting user experience.
                        </p>
                        
                        <a href="{{ route('login') }}" class="relative overflow-hidden group inline-flex items-center px-6 py-3 font-medium text-sm rounded-full text-white bg-gradient-to-r from-blue-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-blue-700/30 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900">
                            <span class="relative z-10">Join The Adventure</span>
                            <span class="absolute inset-0 overflow-hidden rounded-full">
                                <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-60"></span>
                            </span>
                        </a>
                    </div>
                    
                    <div class="order-1 lg:order-2">
                        <div class="magical-card rounded-2xl p-1 bg-gradient-to-r from-purple-500 via-blue-500 to-cyan-500">
                            <div class="bg-white dark:bg-gray-900 rounded-xl p-6 relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1551244072-5d12893278ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Ocean View" class="w-full h-auto rounded-lg">
                                
                                <!-- Decorative Elements -->
                                <div class="absolute top-2 left-2 w-12 h-12 rounded-full bg-gradient-to-r from-pink-500 to-purple-500 opacity-70 blur-md floating"></div>
                                <div class="absolute bottom-2 right-2 w-16 h-16 rounded-full bg-gradient-to-r from-blue-500 to-cyan-500 opacity-70 blur-md floating" style="animation-delay: 1s;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Footer -->
        <footer class="py-12 px-4 relative">
            <div class="container max-w-6xl mx-auto">
                <div class="text-center">
                    <a href="{{ route('home') }}" class="inline-block mb-6">
                        <x-ui.logo class="w-auto h-8 text-transparent fill-current dark:text-transparent" style="fill: url(#magical-logo-gradient-footer)" />
                        
                        {{-- SVG Gradient Definition --}}
                        <svg width="0" height="0">
                            <defs>
                                <linearGradient id="magical-logo-gradient-footer" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#1a91ff" />
                                    <stop offset="50%" stop-color="#5643fd" />
                                    <stop offset="100%" stop-color="#b54aff" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </a>
                    
                    <p class="text-blue-800/70 dark:text-blue-200/70 mb-8">
                        © {{ date('Y') }} Magical Ocean Portal. All rights reserved.
                    </p>
                    
                    <div class="flex items-center justify-center space-x-6">
                        <a href="#" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors duration-300">Terms</a>
                        <a href="#" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors duration-300">Privacy</a>
                        <a href="#" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors duration-300">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @endvolt
</x-layouts.magical-ocean>