<!-- resources/views/components/cyberpunk/header.blade.php -->
<header class="fixed w-full top-0 z-50 bg-opacity-80 backdrop-blur-md bg-black border-b border-blue-500 cyber-grid">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <div class="text-2xl font-bold cyber-glitch neon-text-blue" data-text="CYBERPUNK">
                        <span class="font-orbitron tracking-wider">CYBER</span><span class="text-pink-500 font-orbitron tracking-wider">PUNK</span> 
                        <span class="text-xs font-mono opacity-80">RPG</span>
                    </div>
                </a>
            </div>
            
            <!-- Navigation Links -->
            <div class="hidden md:ml-6 md:flex md:items-center md:space-x-4">
                <a href="{{ route('rules') }}" class="px-3 py-2 text-sm font-medium neon-text-blue hover:text-white hover:bg-gray-800 rounded-md transition-colors duration-150">
                    Rules
                </a>
                <a href="{{ route('npcs') }}" class="px-3 py-2 text-sm font-medium neon-text-blue hover:text-white hover:bg-gray-800 rounded-md transition-colors duration-150">
                    NPCs
                </a>
                <a href="{{ route('characters') }}" class="px-3 py-2 text-sm font-medium neon-text-blue hover:text-white hover:bg-gray-800 rounded-md transition-colors duration-150">
                    Characters
                </a>
                <a href="{{ route('world') }}" class="px-3 py-2 text-sm font-medium neon-text-blue hover:text-white hover:bg-gray-800 rounded-md transition-colors duration-150">
                    World
                </a>
                <a href="{{ route('recaps') }}" class="px-3 py-2 text-sm font-medium neon-text-blue hover:text-white hover:bg-gray-800 rounded-md transition-colors duration-150">
                    Recaps
                </a>
                <a href="{{ route('powers') }}" class="px-3 py-2 text-sm font-medium neon-text-blue hover:text-white hover:bg-gray-800 rounded-md transition-colors duration-150">
                    Powers
                </a>
            </div>
            
            <!-- Right side buttons -->
            <div class="flex items-center">
                @auth
                    @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="mr-4 text-sm font-medium cyber-button">
                        Admin Panel
                    </a>
                    @endif
                    
                    <div x-data="{ open: false }" class="ml-3 relative">
                        <div>
                            <button @click="open = !open" class="flex text-sm border-2 border-blue-500 rounded-full focus:outline-none focus:border-pink-500 transition duration-150 ease-in-out bg-black">
                                <img class="h-8 w-8 rounded-full p-0.5" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=05d9e8&background=0d0221" alt="{{ auth()->user()->name }}">
                            </button>
                        </div>
                        
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg">
                            <div class="cyber-border rounded-md bg-black bg-opacity-90 py-1">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-blue-400 hover:bg-gray-800 hover:text-white">
                                    Your Profile
                                </a>
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-blue-400 hover:bg-gray-800 hover:text-white">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-blue-400 hover:text-white hover:bg-gray-800 px-3 py-2 rounded-md text-sm font-medium mr-2">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="cyber-button">
                        Register
                    </a>
                @endauth
            </div>
            
            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button type="button" @click="$store.mobileMenu.toggle()" class="inline-flex items-center justify-center p-2 rounded-md text-blue-400 hover:text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" x-show="!$store.mobileMenu.open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" x-show="$store.mobileMenu.open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-data="$store.mobileMenu" x-show="open" @click.away="close()" class="md:hidden bg-black border-t border-blue-500" style="display: none;">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('rules') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-400 hover:text-white hover:bg-gray-800">
                Rules
            </a>
            <a href="{{ route('npcs') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-400 hover:text-white hover:bg-gray-800">
                NPCs
            </a>
            <a href="{{ route('characters') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-400 hover:text-white hover:bg-gray-800">
                Characters
            </a>
            <a href="{{ route('world') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-400 hover:text-white hover:bg-gray-800">
                World
            </a>
            <a href="{{ route('recaps') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-400 hover:text-white hover:bg-gray-800">
                Recaps
            </a>
            <a href="{{ route('powers') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-400 hover:text-white hover:bg-gray-800">
                Powers
            </a>
        </div>
        <div class="pt-4 pb-3 border-t border-blue-500">
            @auth
                <div class="flex items-center px-5">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full p-0.5 border-2 border-blue-500" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=05d9e8&background=0d0221" alt="{{ auth()->user()->name }}">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-white">{{ auth()->user()->name }}</div>
                        <div class="text-sm font-medium text-gray-400">{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 px-2 space-y-1">
                    @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-400 hover:text-white hover:bg-gray-800">
                        Admin Panel
                    </a>
                    @endif
                    
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-400 hover:text-white hover:bg-gray-800">
                        Your Profile
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-blue-400 hover:text-white hover:bg-gray-800">
                            Sign out
                        </button>
                    </form>
                </div>
            @else
                <div class="mt-3 px-2 space-y-1">
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-400 hover:text-white hover:bg-gray-800">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-blue-400 hover:text-white hover:bg-gray-800">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</header>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('mobileMenu', {
            open: false,
            toggle() {
                this.open = !this.open;
            },
            close() {
                this.open = false;
            }
        });
    });
</script>