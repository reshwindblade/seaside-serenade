<!-- resources/views/admin/dashboard.blade.php -->
<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Admin Dashboard') }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('home') }}" class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Website
                    </div>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 gap-5 mb-8 md:grid-cols-2 lg:grid-cols-4">
                <!-- Total Users -->
                <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Users</p>
                            <p class="text-3xl font-bold text-gray-700 dark:text-gray-200">{{ $stats['totalUsers'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Rules Stats -->
                <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Rules</p>
                            <p class="text-3xl font-bold text-gray-700 dark:text-gray-200">{{ $stats['rules'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- NPCs Stats -->
                <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 text-pink-500 bg-pink-100 rounded-full dark:bg-pink-900 dark:text-pink-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">NPCs</p>
                            <p class="text-3xl font-bold text-gray-700 dark:text-gray-200">{{ $stats['npcs'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Characters Stats -->
                <div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
                    <div class="flex items-center">
                        <div class="p-3 mr-4 text-yellow-500 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Characters</p>
                            <p class="text-3xl font-bold text-gray-700 dark:text-gray-200">{{ $stats['characters'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Management Cards -->
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Content Management</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Content Cards - General -->
                <a href="{{ route('admin.users-list') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition-all duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 mr-3 text-blue-500 bg-blue-100 rounded-lg dark:bg-blue-900 dark:text-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Manage Users</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">View, edit, and manage user accounts and profiles.</p>
                </a>
                
                <a href="{{ route('admin.rules.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition-all duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 mr-3 text-blue-500 bg-blue-100 rounded-lg dark:bg-blue-900 dark:text-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Manage Rules</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Add, edit, or remove rules and game mechanics for your campaign.</p>
                </a>
                
                <a href="{{ route('admin.npcs.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition-all duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 mr-3 text-pink-500 bg-pink-100 rounded-lg dark:bg-pink-900 dark:text-pink-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Manage NPCs</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Create and manage non-player characters in your cyberpunk world.</p>
                </a>
                
                <a href="{{ route('admin.characters.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition-all duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 mr-3 text-yellow-500 bg-yellow-100 rounded-lg dark:bg-yellow-900 dark:text-yellow-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Manage Characters</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Update player character information and details.</p>
                </a>
                
                <a href="{{ route('admin.world.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition-all duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 mr-3 text-purple-500 bg-purple-100 rounded-lg dark:bg-purple-900 dark:text-purple-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h.5A2.5 2.5 0 0020 5.5v-1.65M12 14.5V17m0 0v2.5M12 17h2.5M12 17h-2.5" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit World Setting</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Update the world lore, history, and setting information.</p>
                </a>
                
                <a href="{{ route('admin.recaps.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition-all duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 mr-3 text-green-500 bg-green-100 rounded-lg dark:bg-green-900 dark:text-green-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Manage Recaps</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Create and edit session recaps to keep track of your campaign's story.</p>
                </a>
            </div>

            <!-- Advanced Content Management Cards -->
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Advanced Content</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="{{ route('admin.powers.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition-all duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 mr-3 text-blue-500 bg-blue-100 rounded-lg dark:bg-blue-900 dark:text-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Manage Powers</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Define and manage special abilities, cybernetic enhancements, and powers.</p>
                </a>
                
                <a href="{{ route('admin.abilities.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition-all duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 mr-3 text-pink-500 bg-pink-100 rounded-lg dark:bg-pink-900 dark:text-pink-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Signature Abilities</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Manage character signature abilities and their effects.</p>
                </a>
                
                <a href="{{ route('admin.talents.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition-all duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 mr-3 text-green-500 bg-green-100 rounded-lg dark:bg-green-900 dark:text-green-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Manage Talents</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Create and manage character talents and specialties.</p>
                </a>
                
                <a href="{{ route('admin.weaknesses.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition-all duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 mr-3 text-red-500 bg-red-100 rounded-lg dark:bg-red-900/40 dark:text-red-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Manage Weaknesses</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Define character weaknesses and limitations.</p>
                </a>
                
                <a href="{{ route('admin.suits.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition-all duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 mr-3 text-blue-500 bg-blue-100 rounded-lg dark:bg-blue-900 dark:text-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Combat Suits</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Manage combat suits and their special effects.</p>
                </a>
                
                <a href="{{ route('admin.stories.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition-all duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 mr-3 text-purple-500 bg-purple-100 rounded-lg dark:bg-purple-900 dark:text-purple-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Short Stories</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">Manage character short stories and background narratives.</p>
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
