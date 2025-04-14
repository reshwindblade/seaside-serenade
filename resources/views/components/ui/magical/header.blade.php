{{-- resources/views/components/ui/magical/header.blade.php --}}
<header x-data="{ mobileMenuOpen: false }" class="w-full bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border-b border-blue-100/80 dark:border-blue-950/50 sticky top-0 z-50">
    <div class="relative z-20 flex items-center justify-between w-full h-20 max-w-6xl px-6 mx-auto">
        <div class="relative flex items-center text-blue-950 dark:text-blue-100">
            
            <div class="relative z-50 flex items-center w-auto h-full">
                <a href="{{ route('home') }}" class="flex items-center mr-0 md:mr-5 shrink-0 transition-transform duration-300 hover:scale-105">
                    <x-ui.logo class="block w-auto h-8 text-transparent fill-current dark:text-transparent" style="fill: url(#magical-logo-gradient)" />
                    
                    {{-- SVG Gradient Definition --}}
                    <svg width="0" height="0">
                        <defs>
                            <linearGradient id="magical-logo-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#1a91ff" />
                                <stop offset="50%" stop-color="#5643fd" />
                                <stop offset="100%" stop-color="#b54aff" />
                            </linearGradient>
                        </defs>
                    </svg>
                </a>
                
                {{-- Mobile Menu Toggle --}}
                <button 
                    @click="mobileMenuOpen = !mobileMenuOpen" 
                    class="relative flex items-center justify-center w-10 h-10 ml-5 overflow-hidden text-blue-500 dark:text-blue-300 bg-blue-50 dark:bg-blue-900/30 rounded-full md:hidden hover:text-blue-600 dark:hover:text-blue-200 hover:bg-blue-100 dark:hover:bg-blue-800/50 transition-all duration-300"
                >
                    <span class="sr-only">Toggle menu</span>
                    <div class="flex flex-col items-center justify-center w-5 h-5">
                        <span 
                            :class="{ 'rotate-45 translate-y-1.5': mobileMenuOpen }" 
                            class="block w-5 h-0.5 bg-current rounded-full transition-transform duration-300"
                        ></span>
                        <span 
                            :class="{ 'opacity-0': mobileMenuOpen }" 
                            class="block w-5 h-0.5 mt-1 bg-current rounded-full transition-opacity duration-300"
                        ></span>
                        <span 
                            :class="{ '-rotate-45 -translate-y-1.5': mobileMenuOpen }" 
                            class="block w-5 h-0.5 mt-1 bg-current rounded-full transition-transform duration-300"
                        ></span>
                    </div>
                </button>
            </div>
            
            {{-- Navigation Menu --}}
            <div 
                x-show="mobileMenuOpen || window.innerWidth >= 768"
                x-transition:enter="transition duration-300 ease-out"
                x-transition:enter-start="opacity-0 -translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition duration-200 ease-in"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-10"
                class="fixed top-0 left-0 z-40 flex-col items-start justify-start hidden w-full h-auto md:h-auto pt-20 pb-6 md:pt-0 md:pb-0 bg-white/95 dark:bg-gray-900/95 backdrop-blur-lg md:backdrop-blur-none space-y-5 text-sm font-medium md:static md:flex md:flex-row md:items-center md:bg-transparent md:w-auto"
                @click.away="if(window.innerWidth < 768) mobileMenuOpen = false"
            >
                <nav class="flex flex-col w-full p-6 pt-0 space-y-1 md:p-0 md:flex-row md:space-x-1 md:space-y-0 md:w-auto">
                    <x-ui.nav-link 
                        href="{{ route('home') }}" 
                        class="px-4 py-2 rounded-full transition-all duration-300 hover:bg-blue-50 dark:hover:bg-blue-900/30"
                    >
                        Home
                    </x-ui.nav-link>
                    
                    {{-- Add more navigation links as needed --}}
                    <x-ui.nav-link 
                        href="#features" 
                        class="px-4 py-2 rounded-full transition-all duration-300 hover:bg-blue-50 dark:hover:bg-blue-900/30"
                    >
                        Features
                    </x-ui.nav-link>
                    
                    <x-ui.nav-link 
                        href="#about" 
                        class="px-4 py-2 rounded-full transition-all duration-300 hover:bg-blue-50 dark:hover:bg-blue-900/30"
                    >
                        About
                    </x-ui.nav-link>
                </nav>
            </div>
        </div>
        
        {{-- Right Side: Dark Mode Toggle & Auth Buttons --}}
        <div class="relative z-50 flex items-center space-x-4 text-blue-950 dark:text-blue-100">
            {{-- Dark Mode Toggle --}}
            <div x-data class="flex-shrink-0 w-10 h-10 overflow-hidden rounded-full">
                <button 
                    x-data="{
                        darkMode: localStorage.getItem('dark_mode') === 'true',
                        toggleDarkMode() {
                            document.documentElement.classList.toggle('dark');
                            this.darkMode = !this.darkMode;
                            localStorage.setItem('dark_mode', this.darkMode);
                        }
                    }" 
                    x-init="darkMode = document.documentElement.classList.contains('dark')"
                    @click="toggleDarkMode()"
                    class="flex items-center justify-center w-full h-full transition-colors duration-300 bg-blue-50 dark:bg-blue-900/30 rounded-full hover:bg-blue-100 dark:hover:bg-blue-800/50"
                >
                    <svg 
                        x-show="!darkMode" 
                        xmlns="http://www.w3.org/2000/svg" 
                        class="h-5 w-5 text-blue-500 dark:text-blue-300" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg 
                        x-show="darkMode" 
                        xmlns="http://www.w3.org/2000/svg" 
                        class="h-5 w-5 text-yellow-400" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>
            </div>
            
            {{-- Auth Buttons --}}
            @auth
                <div class="flex items-center w-auto">
                    <a 
                        href="{{ route('admin.dashboard') }}" 
                        class="relative overflow-hidden inline-flex items-center px-5 py-2.5 font-medium text-sm rounded-full text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-blue-700/30 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900"
                    >
                        <span class="relative z-10">Dashboard</span>
                        <span class="absolute inset-0 overflow-hidden rounded-full">
                            <span class="absolute left-0 w-0 h-full bg-white/20 transition-all duration-700 group-hover:w-full"></span>
                        </span>
                    </a>
                </div>
            @else
                <div class="flex items-center w-auto space-x-3">
                    @if(!config('app.disable_registration'))
                        {{-- Login Link --}}
                        <a 
                            href="{{ route('login') }}" 
                            class="font-medium text-sm text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-200 transition-colors duration-300"
                        >
                            Login
                        </a>
                        
                        {{-- Signup Button --}}
                        <a 
                            href="{{ route('register') }}" 
                            class="relative overflow-hidden inline-flex items-center px-5 py-2.5 font-medium text-sm rounded-full text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-blue-700/30 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900"
                        >
                            <span class="relative z-10">Sign Up</span>
                            <span class="absolute inset-0 overflow-hidden rounded-full">
                                <span class="absolute left-0 w-0 h-full bg-white/20 transition-all duration-700 group-hover:w-full"></span>
                            </span>
                        </a>
                    @else
                        {{-- Login Button (when registration is disabled) --}}
                        <a 
                            href="{{ route('login') }}" 
                            class="relative overflow-hidden inline-flex items-center px-5 py-2.5 font-medium text-sm rounded-full text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-blue-700/30 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900"
                        >
                            <span class="relative z-10">Login</span>
                            <span class="absolute inset-0 overflow-hidden rounded-full">
                                <span class="absolute left-0 w-0 h-full bg-white/20 transition-all duration-700 group-hover:w-full"></span>
                            </span>
                        </a>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</header>