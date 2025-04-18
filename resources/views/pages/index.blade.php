<x-layouts.magical-ocean>
    <!-- Hero Section -->
    <section class="relative pt-20 pb-24 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <!-- Decorative background elements -->
            <div class="absolute top-1/4 left-1/4 w-96 h-96 rounded-full bg-blue-500/10 dark:bg-blue-500/5 blur-3xl transform -translate-x-1/2"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 rounded-full bg-purple-500/10 dark:bg-purple-500/5 blur-3xl transform translate-x-1/2"></div>
        </div>
        
        <div class="container px-6 mx-auto max-w-6xl relative z-10">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <!-- Hero Content -->
                <div class="md:w-1/2 text-center md:text-left" 
                     x-data="{ show: false }" 
                     x-init="setTimeout(() => show = true, 100)">
                    
                    <h1 x-show="show"
                        x-transition:enter="transition ease-out duration-700 transform"
                        x-transition:enter-start="opacity-0 translate-y-12"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="text-4xl md:text-5xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-indigo-500 to-purple-600 dark:from-blue-400 dark:via-indigo-300 dark:to-purple-400">
                        Welcome to the Magical Ocean Portal
                    </h1>
                    
                    <p x-show="show"
                       x-transition:enter="transition ease-out delay-300 duration-700 transform"
                       x-transition:enter-start="opacity-0 translate-y-12"
                       x-transition:enter-end="opacity-100 translate-y-0"
                       class="text-lg md:text-xl text-blue-900 dark:text-blue-100 mb-8 max-w-xl mx-auto md:mx-0">
                        Dive into a world of magical adventures, where the ocean meets mystical powers. Create your magical girl character and join our enchanted community.
                    </p>
                    
                    <div x-show="show"
                         x-transition:enter="transition ease-out delay-500 duration-700 transform"
                         x-transition:enter-start="opacity-0 translate-y-12"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        
                        @auth
                            @if(auth()->user()->hasMagicalGirl())
                                <a href="{{ route('magical-girl.show') }}" 
                                   class="relative overflow-hidden group inline-flex items-center px-8 py-3 font-medium text-base rounded-xl text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-blue-700/30 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 w-full sm:w-auto justify-center">
                                    <span class="relative z-10">View Your Magical Girl</span>
                                    <span class="absolute inset-0 overflow-hidden rounded-xl">
                                        <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-60"></span>
                                    </span>
                                </a>
                                <a href="{{ route('rules') }}" 
                                   class="inline-flex items-center px-8 py-3 font-medium text-base rounded-xl text-blue-600 dark:text-blue-300 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 border border-blue-200 dark:border-blue-800 hover:border-blue-300 dark:hover:border-blue-700 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 w-full sm:w-auto justify-center">
                                    Explore Game Rules
                                </a>
                            @else
                                <a href="{{ route('magical-girl.create') }}" 
                                   class="relative overflow-hidden group inline-flex items-center px-8 py-3 font-medium text-base rounded-xl text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-blue-700/30 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 w-full sm:w-auto justify-center">
                                    <span class="relative z-10">Create Your Magical Girl</span>
                                    <span class="absolute inset-0 overflow-hidden rounded-xl">
                                        <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-60"></span>
                                    </span>
                                </a>
                                <a href="{{ route('rules') }}" 
                                   class="inline-flex items-center px-8 py-3 font-medium text-base rounded-xl text-blue-600 dark:text-blue-300 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 border border-blue-200 dark:border-blue-800 hover:border-blue-300 dark:hover:border-blue-700 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 w-full sm:w-auto justify-center">
                                    Read the Rules First
                                </a>
                            @endif
                        @else
                            @if(!config('app.disable_registration'))
                                <a href="{{ route('register') }}" 
                                   class="relative overflow-hidden group inline-flex items-center px-8 py-3 font-medium text-base rounded-xl text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-blue-700/30 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 w-full sm:w-auto justify-center">
                                    <span class="relative z-10">Join the Adventure</span>
                                    <span class="absolute inset-0 overflow-hidden rounded-xl">
                                        <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-60"></span>
                                    </span>
                                </a>
                            @endif
                            <a href="{{ route('login') }}" 
                               class="inline-flex items-center px-8 py-3 font-medium text-base rounded-xl text-blue-600 dark:text-blue-300 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 border border-blue-200 dark:border-blue-800 hover:border-blue-300 dark:hover:border-blue-700 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 w-full sm:w-auto justify-center">
                                Sign In
                            </a>
                        @endauth
                    </div>
                </div>
                
                <!-- Hero Illustration -->
                <div class="md:w-1/2" 
                     x-data="{ show: false }" 
                     x-init="setTimeout(() => show = true, 700)">
                    <div x-show="show"
                         x-transition:enter="transition ease-out duration-1000 transform"
                         x-transition:enter-start="opacity-0 translate-y-12 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         class="relative">
                        <div class="absolute -left-10 -top-10 w-full h-full bg-gradient-to-br from-blue-500/20 to-purple-500/20 blur-2xl rounded-full animate-pulse"></div>
                        <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 border border-blue-100 dark:border-blue-900">
                            <div class="aspect-w-16 aspect-h-9 overflow-hidden rounded-lg">
                                <img src="https://placehold.co/1200x800/2563eb/FFF?text=Magical+Ocean+Portal" alt="Magical Ocean" class="object-cover w-full h-full rounded-lg"/>
                            </div>
                            <div class="absolute -bottom-3 -right-3 w-24 h-24 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-full animate-float opacity-30"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 relative overflow-hidden bg-blue-50 dark:bg-blue-900/20">
        <div class="container px-6 mx-auto max-w-6xl">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">Explore the Magical Ocean World</h2>
                <p class="text-blue-900/70 dark:text-blue-100/70 max-w-2xl mx-auto">Dive into our features and discover the magical ocean universe!</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1: Rules -->
                <a href="{{ route('rules') }}" class="bg-white dark:bg-gray-800 rounded-xl border border-blue-100 dark:border-blue-800/30 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden group">
                    <div class="h-3 bg-gradient-to-r from-blue-500 to-blue-600"></div>
                    <div class="p-6">
                        <div class="w-14 h-14 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mb-4 group-hover:bg-blue-200 dark:group-hover:bg-blue-800/50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-blue-700 dark:text-blue-300">Game Rules</h3>
                        <p class="text-blue-900/70 dark:text-blue-100/70 mb-4">Learn the game mechanics, character creation rules, and everything you need to start your magical adventure.</p>
                        <div class="flex items-center text-blue-600 dark:text-blue-400 font-medium group-hover:translate-x-1 transition-transform">
                            Explore Rules
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
                
                <!-- Card 2: Characters -->
                <a href="{{ route('characters') }}" class="bg-white dark:bg-gray-800 rounded-xl border border-blue-100 dark:border-blue-800/30 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden group">
                    <div class="h-3 bg-gradient-to-r from-purple-500 to-purple-600"></div>
                    <div class="p-6">
                        <div class="w-14 h-14 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center mb-4 group-hover:bg-purple-200 dark:group-hover:bg-purple-800/50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-purple-700 dark:text-purple-300">Player Characters</h3>
                        <p class="text-blue-900/70 dark:text-blue-100/70 mb-4">Browse other player characters and get inspired for your own magical girl creation.</p>
                        <div class="flex items-center text-purple-600 dark:text-purple-400 font-medium group-hover:translate-x-1 transition-transform">
                            View Characters
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
                
                <!-- Card 3: NPCs -->
                <a href="{{ route('npcs') }}" class="bg-white dark:bg-gray-800 rounded-xl border border-blue-100 dark:border-blue-800/30 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden group">
                    <div class="h-3 bg-gradient-to-r from-pink-500 to-pink-600"></div>
                    <div class="p-6">
                        <div class="w-14 h-14 rounded-lg bg-pink-100 dark:bg-pink-900/30 flex items-center justify-center mb-4 group-hover:bg-pink-200 dark:group-hover:bg-pink-800/50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-pink-600 dark:text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-pink-700 dark:text-pink-300">Non-Player Characters</h3>
                        <p class="text-blue-900/70 dark:text-blue-100/70 mb-4">Meet the NPCs who populate our magical world, from mentors and allies to mysterious foes.</p>
                        <div class="flex items-center text-pink-600 dark:text-pink-400 font-medium group-hover:translate-x-1 transition-transform">
                            Discover NPCs
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 mt-8 gap-8">
                <!-- Card 4: World Setting -->
                <a href="{{ route('world') }}" class="bg-white dark:bg-gray-800 rounded-xl border border-blue-100 dark:border-blue-800/30 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden group">
                    <div class="h-3 bg-gradient-to-r from-green-500 to-emerald-600"></div>
                    <div class="p-6">
                        <div class="w-14 h-14 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center mb-4 group-hover:bg-green-200 dark:group-hover:bg-green-800/50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-green-700 dark:text-green-300">World Setting</h3>
                        <p class="text-blue-900/70 dark:text-blue-100/70 mb-4">Explore the rich lore, locations, and history of our magical ocean setting and universe.</p>
                        <div class="flex items-center text-green-600 dark:text-green-400 font-medium group-hover:translate-x-1 transition-transform">
                            Explore the World
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
                
                <!-- Card 5: Powers -->
                <a href="{{ route('powers') }}" class="bg-white dark:bg-gray-800 rounded-xl border border-blue-100 dark:border-blue-800/30 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 overflow-hidden group">
                    <div class="h-3 bg-gradient-to-r from-amber-500 to-red-600"></div>
                    <div class="p-6">
                        <div class="w-14 h-14 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center mb-4 group-hover:bg-amber-200 dark:group-hover:bg-amber-800/50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-amber-700 dark:text-amber-300">Powers & Abilities</h3>
                        <p class="text-blue-900/70 dark:text-blue-100/70 mb-4">Discover the magical powers, transformations, and special abilities available in our world.</p>
                        <div class="flex items-center text-amber-600 dark:text-amber-400 font-medium group-hover:translate-x-1 transition-transform">
                            Discover Powers
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
</x-layouts.magical-ocean>