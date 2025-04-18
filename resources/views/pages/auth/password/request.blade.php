<x-layouts.magical-ocean>
    <div 
        x-data="{ loaded: false }" 
        x-init="setTimeout(() => loaded = true, 100)"
        class="flex min-h-screen items-center justify-center p-6"
    >
        <div class="absolute inset-0 z-0">
            <!-- Decorative background elements -->
            <div class="absolute top-20 left-1/4 w-72 h-72 rounded-full bg-blue-500/10 dark:bg-blue-500/5 blur-3xl transform -translate-x-1/2"></div>
            <div class="absolute bottom-20 right-1/4 w-80 h-80 rounded-full bg-purple-500/10 dark:bg-purple-500/5 blur-3xl transform translate-x-1/3"></div>
        </div>
        
        <!-- Password Reset Container -->
        <div class="w-full max-w-md z-10">
            <!-- Logo and Heading Section -->
            <div 
                x-show="loaded" 
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform -translate-y-12"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                class="text-center mb-10"
            >
                <a href="{{ route('home') }}" class="inline-block mb-6 transition-transform duration-300 hover:scale-110">
                    <x-ui.logo class="w-auto h-16 text-transparent fill-current dark:text-transparent" style="fill: url(#magical-reset-gradient)" />
                    
                    {{-- SVG Gradient Definition --}}
                    <svg width="0" height="0">
                        <defs>
                            <linearGradient id="magical-reset-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#1a91ff" />
                                <stop offset="50%" stop-color="#5643fd" />
                                <stop offset="100%" stop-color="#b54aff" />
                            </linearGradient>
                        </defs>
                    </svg>
                </a>
                
                <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 dark:from-blue-400 dark:via-indigo-400 dark:to-purple-400">
                    Reset Your Password
                </h1>
                
                <p class="mt-3 text-blue-800/70 dark:text-blue-200/70">
                    Enter your email and we'll send you a password reset link
                </p>
            </div>
            
            <!-- Password Reset Card -->
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
                    
                    <!-- Password Reset Form -->
                    @volt('auth.password.request')
                    <div class="p-8">
                        <div class="mb-8">
                            <div class="p-3 mx-auto w-16 h-16 flex items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
                                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        
                        <form wire:submit="sendResetLink" class="space-y-6">
                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">
                                    Email Address
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input 
                                        wire:model="email" 
                                        id="email" 
                                        name="email" 
                                        type="email" 
                                        autocomplete="email" 
                                        required 
                                        placeholder="your.email@example.com"
                                        class="block w-full pl-10 pr-3 py-3 border border-blue-200 dark:border-blue-800 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 bg-blue-50/50 dark:bg-blue-900/20 text-blue-900 dark:text-blue-100 placeholder-blue-400/70 dark:placeholder-blue-500/70 transition-colors duration-200"
                                    >
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Submit Button -->
                            <div>
                                <button 
                                    type="submit" 
                                    class="relative overflow-hidden group w-full flex justify-center py-3 px-4 border border-transparent rounded-xl font-medium text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-blue-700/30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 transition-all duration-300 hover:scale-[1.02]"
                                >
                                    <span class="relative z-10">Send Reset Link</span>
                                    <span class="absolute inset-0 overflow-hidden rounded-xl">
                                        <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-80"></span>
                                    </span>
                                </button>
                            </div>
                            
                            <!-- Back to Login Link -->
                            <div class="text-center mt-6">
                                <a href="{{ route('login') }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors duration-200">
                                    Back to login
                                </a>
                            </div>
                        </form>
                    </div>
                    @endvolt
                    
                    <!-- Visual element: bubbles decoration -->
                    <div aria-hidden="true" class="absolute top-5 right-5 w-6 h-6 rounded-full bg-blue-400/30 dark:bg-blue-400/20 floating"></div>
                    <div aria-hidden="true" class="absolute bottom-10 left-8 w-4 h-4 rounded-full bg-purple-400/30 dark:bg-purple-400/20 floating" style="animation-delay: 1s;"></div>
                    <div aria-hidden="true" class="absolute top-1/2 right-10 w-8 h-8 rounded-full bg-cyan-400/30 dark:bg-cyan-400/20 floating" style="animation-delay: 2s;"></div>
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
        
        <!-- Animated floating stars -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
            <div class="star-container absolute inset-0">
                <div class="star absolute top-1/4 left-1/5 w-1 h-1 bg-white rounded-full animate-pulse" style="animation-delay: 0.3s; opacity: 0.8;"></div>
                <div class="star absolute top-1/3 right-1/4 w-1.5 h-1.5 bg-white rounded-full animate-pulse" style="animation-delay: 1.1s; opacity: 0.7;"></div>
                <div class="star absolute bottom-1/4 left-1/3 w-1 h-1 bg-white rounded-full animate-pulse" style="animation-delay: 0.7s; opacity: 0.6;"></div>
                <div class="star absolute top-2/3 right-1/5 w-2 h-2 bg-white rounded-full animate-pulse" style="animation-delay: 1.5s; opacity: 0.7;"></div>
                <div class="star absolute bottom-1/3 left-1/2 w-1.5 h-1.5 bg-white rounded-full animate-pulse" style="animation-delay: 0.2s; opacity: 0.8;"></div>
            </div>
        </div>
    </div>
    
    <style>
        .star-container {
            filter: blur(0.5px);
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 0.2;
                transform: scale(1);
            }
            50% {
                opacity: 1;
                transform: scale(1.5);
            }
        }
        
        .animate-pulse {
            animation: pulse 3s ease-in-out infinite;
        }
    </style>
</x-layouts.magical-ocean>