{{-- resources/views/components/ui/improved-header.blade.php --}}
<header class="bg-white dark:bg-gray-900 border-b border-gray-200/80 dark:border-gray-200/[15%]">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo and Dashboard Title -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center shrink-0">
                    <x-ui.logo class="block w-auto text-gray-800 fill-current h-7 dark:text-gray-200" />
                </a>
                <h2 class="ml-4 text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Admin Dashboard
                </h2>
            </div>

            <!-- Navigation & User Controls -->
            <div class="flex items-center space-x-4">
                <!-- Theme Toggle -->
                <div class="w-[38px] h-[38px] overflow-hidden rounded-full">
                    <x-ui.light-dark-switch></x-ui.light-dark-switch>
                </div>
                
                <!-- User Dropdown -->
                <div x-data="{ dropdownOpen: false }" class="relative flex-shrink-0">
                    <button @click="dropdownOpen=!dropdownOpen" class="inline-flex items-center justify-between px-3.5 py-2 text-sm font-medium text-gray-500 transition duration-0 bg-white border rounded-full hover:bg-slate-200/50 dark:text-white/70 dark:hover:text-gray-100 dark:bg-transparent dark:hover:bg-gray-800/70 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ml-1">
                            <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </div>
                    </button>
                    <div x-show="dropdownOpen" @click.away="dropdownOpen=false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" 
                        class="absolute right-0 z-50 w-40 mt-2 origin-top-right" x-cloak>
                        <div class="py-2 bg-white rounded-lg shadow-md dark:bg-gray-900 dark:shadow-xl border border-gray-200/70 dark:border-white/10">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
                                    Log out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>