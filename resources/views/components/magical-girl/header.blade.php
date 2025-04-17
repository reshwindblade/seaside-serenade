<?php
// resources/views/components/magical-girl/header.blade.php
?>
<header x-data="{ mobileMenuOpen: false }" class="bg-white/80 dark:bg-purple-900/50 backdrop-blur-sm border-b border-pink-100 dark:border-purple-800/30 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                    <div class="flex items-center">
                        <!-- Star logo icon -->
                        <svg class="h-8 w-8 text-pink-500 mr-2" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 1L15.5 8.5L23 9.5L17.5 15.5L19 23L12 19.5L5 23L6.5 15.5L1 9.5L8.5 8.5L12 1Z" />
                        </svg>
                        <span class="font-bold text-xl text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-purple-600 dark:from-pink-300 dark:to-purple-300">
                            Magical Girl Portal
                        </span>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <div class="hidden sm:ml-6 sm:flex sm:items-center sm:space-x-4">
                <a href="{{ route('home') }}" class="nav-link-magical {{ request()->routeIs('home') ? 'active' : '' }}">
                    Home
                </a>
                <a href="{{ route('rules') }}" class="nav-link-magical {{ request()->routeIs('rules*') ? 'active' : '' }}">
                    Rules
                </a>
                <a href="{{ route('npcs') }}" class="nav-link-magical {{ request()->routeIs('npcs*') ? 'active' : '' }}">
                    NPCs
                </a>
                <a href="{{ route('characters') }}" class="nav-link-magical {{ request()->routeIs('characters*') ? 'active' : '' }}">
                    Characters
                </a>
                <a href="{{ route('world') }}" class="nav-link-magical {{ request()->routeIs('world*') ? 'active' : '' }}">
                    World Setting
                </a>
                <a href="{{ route('recaps') }}" class="nav-link-magical {{ request()->routeIs('recaps*') ? 'active' : '' }}">
                    Recaps
                </a>
                <a href="{{ route('powers') }}" class="nav-link-magical {{ request()->routeIs('powers*') ? 'active' : '' }}">
                    Powers
                </a>

                @auth
                <a href="{{ route('magical-girl.show') }}" class="nav-link-magical {{ request()->routeIs('magical-girl.*') ? 'active' : '' }}">
                    My Magical Girl
                </a>
                @endauth
            </div>

            <!-- Right side actions -->
            <div class="flex items-center">
                <!-- Dark mode toggle -->
                <div class="mr-2 w-10 h-10 overflow-hidden rounded-full flex items-center justify-center">
                    <x-ui.light-dark-switch />
                </div>

                @auth
                    <div class="ml-3 relative" x-data="{ open: false }">
                        <div>
                            <button @click="open = !open" class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500" id="user-menu-button">
                                <span class="sr-only">Open user menu</span>
                                <div class="h-8 w-8 rounded-full bg-gradient-to-r from-pink-400 to-purple-500 flex items-center justify-center text-white font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </button>
                        </div>
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-48 rounded-lg shadow-lg bg-white dark:bg-purple-900 ring-1 ring-black ring-opacity-5 py-1" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Profile link -->
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-pink-50 dark:hover:bg-pink-800/20" role="menuitem">
                                Profile
                            </a>
                            
                            @if(Auth::user()->is_admin)
                                <!-- Admin panel link -->
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-pink-50 dark:hover:bg-pink-800/20" role="menuitem">
                                    Admin Panel
                                </a>
                            @endif
                            
                            <!-- Logout form -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-pink-50 dark:hover:bg-pink-800/20" role="menuitem">
                                    Log out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-pink-600 dark:text-pink-300 hover:text-pink-800 dark:hover:text-pink-200 mr-4">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="btn-magical">
                        Register
                    </a>
                @endauth
                
                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="sm:hidden ml-2 bg-white dark:bg-purple-800 p-2 rounded-md text-pink-500 dark:text-pink-300 hover:text-pink-600 dark:hover:text-pink-200 hover:bg-pink-50 dark:hover:bg-purple-700 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileMenuOpen" class="sm:hidden bg-white/95 dark:bg-purple-900/95 backdrop-blur-sm border-b border-pink-100 dark:border-purple-800/30">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="nav-link-magical block {{ request()->routeIs('home') ? 'active' : '' }}">
                Home
            </a>
            <a href="{{ route('rules') }}" class="nav-link-magical block {{ request()->routeIs('rules*') ? 'active' : '' }}">
                Rules
            </a>
            <a href="{{ route('npcs') }}" class="nav-link-magical block {{ request()->routeIs('npcs*') ? 'active' : '' }}">
                NPCs
            </a>
            <a href="{{ route('characters') }}" class="nav-link-magical block {{ request()->routeIs('characters*') ? 'active' : '' }}">
                Characters
            </a>
            <a href="{{ route('world') }}" class="nav-link-magical block {{ request()->routeIs('world*') ? 'active' : '' }}">
                World Setting
            </a>
            <a href="{{ route('recaps') }}" class="nav-link-magical block {{ request()->routeIs('recaps*') ? 'active' : '' }}">
                Recaps
            </a>
            <a href="{{ route('powers') }}" class="nav-link-magical block {{ request()->routeIs('powers*') ? 'active' : '' }}">
                Powers
            </a>
        </div>
    </div>
</header>