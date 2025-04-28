{{-- Main Site Navigation Component --}}
<header x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-50 w-full bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border-b border-blue-100/80 dark:border-blue-950/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <div class="h-10 w-10 overflow-hidden relative mr-3">
                        <!-- Logo Mark (Star with gradient) -->
                        <svg class="h-full w-full" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="navLogoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#1a91ff" />
                                    <stop offset="50%" stop-color="#5643fd" />
                                    <stop offset="100%" stop-color="#b54aff" />
                                </linearGradient>
                            </defs>
                            <path d="M12 1L15.5 8.5L23 9.5L17.5 15.5L19 23L12 19.5L5 23L6.5 15.5L1 9.5L8.5 8.5L12 1Z" fill="url(#navLogoGradient)" />
                        </svg>
                    </div>
                    <span class="font-bold text-lg text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 dark:from-blue-400 dark:via-indigo-400 dark:to-purple-400">
                        Magical Ocean Portal
                    </span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-6">
                <a href="{{ route('rules') }}" class="text-blue-900 dark:text-blue-100 hover:text-blue-600 dark:hover:text-blue-400 py-2 transition-colors {{ request()->routeIs('rules*') ? 'font-medium text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400' : '' }}">
                    Rules
                </a>
                <a href="{{ route('characters') }}" class="text-blue-900 dark:text-blue-100 hover:text-blue-600 dark:hover:text-blue-400 py-2 transition-colors {{ request()->routeIs('characters*') ? 'font-medium text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400' : '' }}">
                    Characters
                </a>
                <a href="{{ route('npcs') }}" class="text-blue-900 dark:text-blue-100 hover:text-blue-600 dark:hover:text-blue-400 py-2 transition-colors {{ request()->routeIs('npcs*') ? 'font-medium text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400' : '' }}">
                    NPCs
                </a>
                <a href="{{ route('world') }}" class="text-blue-900 dark:text-blue-100 hover:text-blue-600 dark:hover:text-blue-400 py-2 transition-colors {{ request()->routeIs('world*') ? 'font-medium text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400' : '' }}">
                    World
                </a>
                <a href="{{ route('powers') }}" class="text-blue-900 dark:text-blue-100 hover:text-blue-600 dark:hover:text-blue-400 py-2 transition-colors {{ request()->routeIs('powers*') ? 'font-medium text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400' : '' }}">
                    Powers
                </a>
                <a href="{{ route('recaps') }}" class="text-blue-900 dark:text-blue-100 hover:text-blue-600 dark:hover:text-blue-400 py-2 transition-colors {{ request()->routeIs('recaps*') ? 'font-medium text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400' : '' }}">
                    Recaps
                </a>
                
                @auth
                    <li>
                        <a href="{{ route('magical-girl.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                            My Magical Girls
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('magical-girl.create') }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                            Create New Character
                        </a>
                    </li>
                @endauth
            </nav>

            <!-- Right Side (Dark Mode & Auth) -->
            <div class="flex items-center space-x-4">
                <!-- Dark Mode Toggle -->
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
                    class="flex items-center justify-center w-9 h-9 transition-colors duration-300 bg-blue-50 dark:bg-blue-900/30 rounded-full hover:bg-blue-100 dark:hover:bg-blue-800/50"
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
                        x-cloak
                        xmlns="http://www.w3.org/2000/svg" 
                        class="h-5 w-5 text-yellow-400" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>

                <!-- Auth Menu -->
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button 
                            @click="open = !open" 
                            class="flex items-center space-x-2 focus:outline-none"
                        >
                            <div class="h-9 w-9 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="hidden md:inline-block text-sm font-medium text-blue-900 dark:text-blue-100">
                                {{ Str::limit(Auth::user()->name, 12) }}
                            </span>
                            <svg class="w-5 h-5 text-blue-900 dark:text-blue-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div 
                            x-show="open" 
                            x-cloak
                            @click.away="open = false" 
                            x-transition:enter="transition ease-out duration-100" 
                            x-transition:enter-start="transform opacity-0 scale-95" 
                            x-transition:enter-end="transform opacity-100 scale-100" 
                            x-transition:leave="transition ease-in duration-75" 
                            x-transition:leave-start="transform opacity-100 scale-100" 
                            x-transition:leave-end="transform opacity-0 scale-95" 
                            class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 border border-blue-100 dark:border-blue-900/30"
                        >
                            <div class="border-b border-blue-100 dark:border-blue-900/30 pb-1 mb-1">
                                <div class="px-4 py-2">
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/30">
                                Profile Settings
                            </a>
                            
                            @if(Auth::user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/30">
                                    Admin Dashboard
                                </a>
                            @endif
                            
                            @if(Auth::user()->hasMagicalGirl())
                                <a href="{{ route('magical-girl.show') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/30">
                                    My Magical Girl
                                </a>
                                <a href="{{ route('magical-girl.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/30">
                                    Edit Character
                                </a>
                            @else
                                <a href="{{ route('magical-girl.create') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/30">
                                    Create Magical Girl
                                </a>
                            @endif
                            
                            <div class="border-t border-blue-100 dark:border-blue-900/30 pt-1 mt-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
                            Sign In
                        </a>
                        
                        @if(!config('app.disable_registration', false))
                            <a href="{{ route('register') }}" class="text-sm font-medium px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white transition-colors">
                                Register
                            </a>
                        @endif
                    </div>
                @endauth
                
                <!-- Mobile Menu Button -->
                <button 
                    @click="mobileMenuOpen = !mobileMenuOpen" 
                    class="md:hidden bg-blue-50 dark:bg-blue-900/30 p-2 rounded-lg text-blue-500 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-800/50 focus:outline-none"
                >
                    <svg 
                        x-show="!mobileMenuOpen" 
                        class="h-6 w-6" 
                        xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg 
                        x-show="mobileMenuOpen" 
                        x-cloak
                        class="h-6 w-6" 
                        xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div 
        x-show="mobileMenuOpen" 
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="md:hidden bg-white dark:bg-gray-900 border-b border-blue-100 dark:border-blue-900/30"
    >
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('rules') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors {{ request()->routeIs('rules*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30' : 'text-blue-900 dark:text-blue-100' }}">
                Rules
            </a>
            <a href="{{ route('characters') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors {{ request()->routeIs('characters*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30' : 'text-blue-900 dark:text-blue-100' }}">
                Characters
            </a>
            <a href="{{ route('npcs') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors {{ request()->routeIs('npcs*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30' : 'text-blue-900 dark:text-blue-100' }}">
                NPCs
            </a>
            <a href="{{ route('world') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors {{ request()->routeIs('world*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30' : 'text-blue-900 dark:text-blue-100' }}">
                World
            </a>
            <a href="{{ route('powers') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors {{ request()->routeIs('powers*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30' : 'text-blue-900 dark:text-blue-100' }}">
                Powers
            </a>
            <a href="{{ route('recaps') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors {{ request()->routeIs('recaps*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30' : 'text-blue-900 dark:text-blue-100' }}">
                Recaps
            </a>
            
            @auth
                @if(Auth::user()->hasMagicalGirl())
                    <div class="pt-2 mt-2 border-t border-blue-100 dark:border-blue-900/30">
                        <a href="{{ route('magical-girl.show') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors {{ request()->routeIs('magical-girl.show*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30' : 'text-blue-900 dark:text-blue-100' }}">
                            View My Magical Girl
                        </a>
                        <a href="{{ route('magical-girl.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors {{ request()->routeIs('magical-girl.edit*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30' : 'text-blue-900 dark:text-blue-100' }}">
                            Edit Character
                        </a>
                    </div>
                @else
                    <div class="pt-2 mt-2 border-t border-blue-100 dark:border-blue-900/30">
                        <a href="{{ route('magical-girl.create') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors {{ request()->routeIs('magical-girl.create*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30' : 'text-blue-900 dark:text-blue-100' }}">
                            Create Magical Girl
                        </a>
                    </div>
                @endif
                
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors {{ request()->routeIs('admin.*') ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30' : 'text-blue-900 dark:text-blue-100' }}">
                        Admin Dashboard
                    </a>
                @endif
            @endauth
        </div>
    </div>
</header>