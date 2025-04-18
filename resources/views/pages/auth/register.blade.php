{{-- resources/views/pages/auth/register.blade.php --}}
<x-layouts.magical-ocean>
    <div 
        x-data="{ loaded: false, step: 1 }" 
        x-init="setTimeout(() => loaded = true, 100)" 
        class="flex min-h-screen items-center justify-center p-6"
    >
        <div class="absolute inset-0 z-0">
            <!-- Decorative background elements -->
            <div class="absolute top-10 left-1/3 w-96 h-96 rounded-full bg-blue-500/10 dark:bg-blue-500/5 blur-3xl"></div>
            <div class="absolute bottom-10 right-1/3 w-72 h-72 rounded-full bg-purple-500/10 dark:bg-purple-500/5 blur-3xl"></div>
            <div class="absolute top-1/4 right-1/4 w-64 h-64 rounded-full bg-cyan-500/10 dark:bg-cyan-500/5 blur-3xl"></div>
        </div>
        
        <!-- Registration Container -->
        <div class="w-full max-w-xl z-10">
            <!-- Logo and Heading Section -->
            <div 
                x-show="loaded" 
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform -translate-y-12"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                class="text-center mb-10"
            >
                <a href="{{ route('home') }}" class="inline-block mb-6 transition-transform duration-300 hover:scale-110">
                    <x-ui.logo class="w-auto h-16 text-transparent fill-current dark:text-transparent" style="fill: url(#magical-register-gradient)" />
                    
                    {{-- SVG Gradient Definition --}}
                    <svg width="0" height="0">
                        <defs>
                            <linearGradient id="magical-register-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#1a91ff" />
                                <stop offset="50%" stop-color="#5643fd" />
                                <stop offset="100%" stop-color="#b54aff" />
                            </linearGradient>
                        </defs>
                    </svg>
                </a>
                
                <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 dark:from-blue-400 dark:via-indigo-400 dark:to-purple-400">
                    Join Our Magical Ocean
                </h1>
                
                <p class="mt-3 text-blue-800/70 dark:text-blue-200/70">
                    Create your account to begin the adventure or 
                    <a href="{{ route('login') }}" class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors duration-300">sign in</a>
                </p>
            </div>
            
            <!-- Registration Card -->
            <div 
                x-show="loaded" 
                x-transition:enter="transition ease-out duration-500 delay-200"
                x-transition:enter-start="opacity-0 transform translate-y-12"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                class="relative"
            >
                <!-- Card with gradient border -->
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 rounded-2xl blur-[2px]"></div>
                
                <div class="relative bg-white dark:bg-gray-900 rounded-2xl shadow-xl overflow-hidden">
                    <!-- Visual element: wave decoration at the top -->
                    <div class="h-3 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>
                    
                    <!-- Registration Form -->
                    <div class="p-8">
                        @livewire('auth.register')
                    </div>
                    
                    <!-- Visual element: bubbles decoration -->
                    <div aria-hidden="true" class="absolute top-20 right-6 w-6 h-6 rounded-full bg-blue-400/30 dark:bg-blue-400/20 floating"></div>
                    <div aria-hidden="true" class="absolute bottom-16 left-10 w-5 h-5 rounded-full bg-purple-400/30 dark:bg-purple-400/20 floating" style="animation-delay: 1.2s;"></div>
                    <div aria-hidden="true" class="absolute top-1/3 right-8 w-4 h-4 rounded-full bg-cyan-400/30 dark:bg-cyan-400/20 floating" style="animation-delay: 0.5s;"></div>
                    <div aria-hidden="true" class="absolute bottom-1/3 left-6 w-8 h-8 rounded-full bg-pink-400/30 dark:bg-pink-400/20 floating" style="animation-delay: 1.8s;"></div>
                </div>
            </div>
            
            <!-- Back to Home Link -->
            <div 
                x-show="loaded" 
                x-transition:enter="transition ease-out duration-500 delay-400"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                class="mt-6 text-center"
            >
                <a href="{{ route('home') }}" class="text-sm font-medium text-blue-800/70 dark:text-blue-200/70 hover:text-blue-900 dark:hover:text-blue-100 transition-colors duration-200">
                    <span class="inline-block mr-1">←</span> Back to home
                </a>
            </div>
        </div>
    </div>
</x-layouts.magical-ocean>