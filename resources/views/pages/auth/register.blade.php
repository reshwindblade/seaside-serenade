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
                    @volt('auth.register')
                    <div class="p-8">
                        <form wire:submit="register" class="space-y-6">
                            <!-- Multi-step form navigation -->
                            <div class="relative mb-8">
                                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                    <div class="w-full border-t border-blue-200 dark:border-blue-800"></div>
                                </div>
                                <div class="relative flex justify-center">
                                    <span 
                                        @click="step = 1" 
                                        :class="{ 'bg-blue-600 dark:bg-blue-500 text-white': step === 1, 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 cursor-pointer': step !== 1 }"
                                        class="relative z-10 flex items-center justify-center w-8 h-8 rounded-full text-sm font-medium transition-colors duration-300"
                                    >
                                        1
                                    </span>
                                    <div :class="{ 'border-blue-600 dark:border-blue-500': step > 1, 'border-blue-200 dark:border-blue-800': step <= 1 }" class="relative z-0 w-12 border-t transition-colors duration-300"></div>
                                    <span 
                                        @click="step > 1 ? step = 2 : null" 
                                        :class="{ 'bg-blue-600 dark:bg-blue-500 text-white': step === 2, 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 cursor-pointer': step > 1, 'bg-gray-100 dark:bg-gray-800 text-gray-400 dark:text-gray-500': step < 2 }"
                                        class="relative z-10 flex items-center justify-center w-8 h-8 rounded-full text-sm font-medium transition-colors duration-300"
                                    >
                                        2
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Step 1: Personal Information -->
                            <div x-show="step === 1" class="space-y-6">
                                <!-- Name Field -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">
                                        Full Name
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <input 
                                            wire:model="name" 
                                            id="name" 
                                            name="name" 
                                            type="text" 
                                            required 
                                            placeholder="John Doe"
                                            class="block w-full pl-10 pr-3 py-3 border border-blue-200 dark:border-blue-800 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 bg-blue-50/50 dark:bg-blue-900/20 text-blue-900 dark:text-blue-100 placeholder-blue-400/70 dark:placeholder-blue-500/70 transition-colors duration-200"
                                        >
                                    </div>
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Navigation Buttons -->
                                <div class="flex space-x-4">
                                    <button 
                                        type="button" 
                                        @click="step = 1"
                                        class="w-full flex justify-center py-3 px-4 border border-blue-300 dark:border-blue-700 rounded-xl font-medium text-blue-600 dark:text-blue-400 bg-blue-50/50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-800/30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 transition-all duration-300"
                                    >
                                        Back
                                    </button>
                                    
                                    <button 
                                        type="submit" 
                                        class="relative overflow-hidden group w-full flex justify-center py-3 px-4 border border-transparent rounded-xl font-medium text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-blue-700/30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 transition-all duration-300 hover:scale-[1.02]"
                                    >
                                        <span class="relative z-10">Register</span>
                                        <span class="absolute inset-0 overflow-hidden rounded-xl">
                                            <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-80"></span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endvolt
                    
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