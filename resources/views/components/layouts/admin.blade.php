<!-- resources/views/components/layouts/admin.blade.php -->
<x-layouts.main>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Sidebar -->
        <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0 border-r border-gray-200 dark:border-gray-700">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center ml-6 text-lg font-bold text-gray-800 dark:text-gray-200">
                    <x-ui.logo class="w-auto h-6 mr-3" />
                    Admin Portal
                </a>
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        @if(request()->routeIs('admin.dashboard'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 dark:bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                        @endif
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('admin.dashboard') ? 'text-gray-800 dark:text-gray-100' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </li>

                    <li class="relative px-6 py-3">
                        @if(request()->routeIs('admin.users*'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 dark:bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                        @endif
                        <a href="{{ route('admin.users-list') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('admin.users*') ? 'text-gray-800 dark:text-gray-100' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="ml-4">User Management</span>
                        </a>
                    </li>

                    <li class="relative px-6 py-3">
                        @if(request()->routeIs('admin.settings*'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 dark:bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                        @endif
                        <a href="{{ route('admin.settings') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('admin.settings*') ? 'text-gray-800 dark:text-gray-100' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="ml-4">Settings</span>
                        </a>
                    </li>

                    <li class="relative px-6 py-3">
                        @if(request()->routeIs('api.docs*'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 dark:bg-blue-500 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                        @endif
                        <a href="{{ route('api.docs') }}" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('api.docs*') ? 'text-gray-800 dark:text-gray-100' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="ml-4">API Documentation</span>
                        </a>
                    </li>
                </ul>
                <div class="px-6 mt-10">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-700 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Mobile sidebar -->
        <div x-data="{ isSideMenuOpen: false }" class="flex flex-col flex-1">
            <div class="relative z-10 flex items-center justify-between h-16 bg-white shadow-md dark:bg-gray-800 md:hidden">
                <div class="ml-5">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center text-lg font-bold text-gray-800 dark:text-gray-200">
                        <x-ui.logo class="w-auto h-6 mr-3" />
                        Admin
                    </a>
                </div>
                
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 overflow-hidden rounded-full" x-cloak>
                        <x-ui.light-dark-switch></x-ui.light-dark-switch>
                    </div>

                    <button @click="isSideMenuOpen = !isSideMenuOpen" class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="w-6 h-6 text-gray-500 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile sidebar menu -->
            <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-20 flex md:hidden" style="display: none;">
                <div @click="isSideMenuOpen = false" x-show="isSideMenuOpen" x-transition:enter="transition-opacity ease-linear duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-30" aria-hidden="true"></div>
                
                <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="-translate-x-20" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-20" class="fixed inset-y-0 left-0 z-30 w-2/3 max-w-sm overflow-y-auto bg-white dark:bg-gray-800 sm:w-3/5 transform">
                    <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center text-lg font-bold text-gray-800 dark:text-gray-200">
                            <x-ui.logo class="w-auto h-6 mr-3" />
                            Admin Portal
                        </a>
                        <button @click="isSideMenuOpen = false" class="w-8 h-8 flex items-center justify-center text-gray-500 rounded-md dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <ul class="py-4">
                        <li class="relative px-4 py-3">
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('admin.dashboard') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-600 dark:text-gray-400' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                <span class="ml-4">Dashboard</span>
                            </a>
                        </li>
                        <li class="relative px-4 py-3">
                            <a href="{{ route('admin.users-list') }}" class="flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('admin.users*') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-600 dark:text-gray-400' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <span class="ml-4">User Management</span>
                            </a>
                        </li>
                        <li class="relative px-4 py-3">
                            <a href="{{ route('admin.settings') }}" class="flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('admin.settings*') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-600 dark:text-gray-400' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="ml-4">Settings</span>
                            </a>
                        </li>
                        <li class="relative px-4 py-3">
                            <a href="{{ route('api.docs') }}" class="flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('api.docs*') ? 'text-gray-800 dark:text-gray-100' : 'text-gray-600 dark:text-gray-400' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="ml-4">API Documentation</span>
                            </a>
                        </li>
                    </ul>
                    <div class="px-4 mt-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-700 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 dark:bg-gray-900">
                <!-- Page header -->
                <header class="bg-white dark:bg-gray-800 shadow-sm">
                    <div class="flex justify-between items-center px-6 py-3">
                        <h1 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                            {{ $header ?? 'Dashboard' }}
                        </h1>
                        <div class="flex items-center space-x-3">
                            <!-- Desktop dark mode toggle -->
                            <div class="hidden md:block">
                                <div class="w-9 h-9 overflow-hidden rounded-full" x-cloak>
                                    <x-ui.light-dark-switch></x-ui.light-dark-switch>
                                </div>
                            </div>
                            
                            <!-- User dropdown -->
                            <div x-data="{ isUserMenuOpen: false }" class="relative">
                                <button @click="isUserMenuOpen = !isUserMenuOpen" class="flex items-center text-sm font-medium text-gray-500 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:text-gray-400 dark:focus:ring-offset-gray-800">
                                    <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff" alt="{{ Auth::user()->name }}">
                                    <span class="ml-2 hidden md:block">{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                
                                <div x-show="isUserMenuOpen" @click.away="isUserMenuOpen = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-48 mt-2 origin-top-right bg-white rounded-md shadow-lg dark:bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none" style="display: none;">
                                    <div class="py-1">
                                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                            Your Profile
                                        </a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                                Sign out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                
                <div class="container px-6 mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</x-layouts.main>