<!-- resources/views/cyberpunk/home.blade.php -->
<x-layouts.cyberpunk>
    <!-- Hero Section -->
    <section class="relative flex items-center justify-center min-h-screen overflow-hidden">
        <div class="absolute inset-0 z-0 from-black to-transparent bg-gradient-to-t"></div>
        
        <div class="absolute inset-0 z-10">
            <div class="absolute inset-0 cyber-grid opacity-10"></div>
            <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-black to-transparent"></div>
        </div>
        
        <div class="relative z-20 px-6 py-20 mx-auto text-center max-w-6xl">
            <h1 class="mb-6 text-5xl sm:text-7xl font-bold tracking-tight text-white font-orbitron">
                <span class="inline-block cyber-glitch" data-text="CYBERPUNK">CYBER</span>
                <span class="inline-block neon-text-pink">PUNK</span>
                <span class="inline-block neon-text-blue">RPG</span>
            </h1>
            <p class="mb-10 text-xl leading-relaxed text-gray-300 md:text-2xl max-w-3xl mx-auto">
                Immerse yourself in a gritty dystopian future where megacorporations rule, and everyone is fighting to survive in a world of advanced technology, body augmentation, and social unrest.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('rules') }}" class="cyber-button">
                    GET STARTED
                </a>
                <a href="{{ route('characters') }}" class="bg-opacity-50 border border-gray-500 hover:border-blue-400 py-3 px-6 text-blue-400 hover:text-white transition rounded-md">
                    MEET THE CAST
                </a>
            </div>
        </div>
        
        <!-- Animated background elements -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <div class="absolute top-0 -left-10 w-40 h-40 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
            <div class="absolute top-20 right-10 w-60 h-60 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-10 left-1/3 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-4000"></div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-black bg-opacity-60 cyber-grid">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white font-orbitron mb-4">EXPLORE THE WORLD</h2>
                <p class="max-w-3xl mx-auto text-gray-400">Discover everything you need to know about our Cyberpunk RPG campaign.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <a href="{{ route('rules') }}" class="cyber-card p-6 transform hover:scale-105 transition-all duration-300">
                    <div class="h-12 w-12 rounded-full border border-blue-500 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 font-orbitron">Rules & How to Play</h3>
                    <p class="text-gray-400">Learn the basics and get familiar with the game mechanics.</p>
                </a>
                
                <a href="{{ route('npcs') }}" class="cyber-card p-6 transform hover:scale-105 transition-all duration-300">
                    <div class="h-12 w-12 rounded-full border border-pink-500 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 font-orbitron">NPCs</h3>
                    <p class="text-gray-400">Meet the non-player characters that shape the world around you.</p>
                </a>
                <a href="{{ route('characters') }}" class="cyber-card p-6 transform hover:scale-105 transition-all duration-300">
                    <div class="h-12 w-12 rounded-full border border-yellow-500 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 font-orbitron">Player Characters</h3>
                    <p class="text-gray-400">Get to know the main protagonists of our cyberpunk story.</p>
                </a>
            </div>
            
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8">
                <a href="{{ route('world') }}" class="cyber-card p-6 transform hover:scale-105 transition-all duration-300">
                    <div class="h-12 w-12 rounded-full border border-purple-500 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h.5A2.5 2.5 0 0020 5.5v-1.65M12 14.5V17m0 0v2.5M12 17h2.5M12 17h-2.5" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 font-orbitron">World Setting</h3>
                    <p class="text-gray-400">Explore the lore, locations, and history of our cyberpunk universe.</p>
                </a>
                
                <a href="{{ route('recaps') }}" class="cyber-card p-6 transform hover:scale-105 transition-all duration-300">
                    <div class="h-12 w-12 rounded-full border border-green-500 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 font-orbitron">Adventure Recaps</h3>
                    <p class="text-gray-400">Catch up on previous sessions and follow the story so far.</p>
                </a>
            </div>
            
            <div class="mt-12 mx-auto max-w-md">
                <a href="{{ route('signature-abilities') }}" class="cyber-card p-6 transform hover:scale-105 transition-all duration-300 block">
                    <div class="h-12 w-12 rounded-full border border-blue-500 flex items-center justify-center mb-4 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 font-orbitron text-center">Signature Abilities</h3>
                    <p class="text-gray-400 text-center">Discover the extraordinary powers and unique skills of our characters.</p>
                </a>
            </div>
        </div>
    </section>
    
    <!-- Join Us Section -->
    <section class="py-16 relative">
        <div class="absolute inset-0 cyber-grid opacity-5"></div>
        <div class="relative z-10 max-w-5xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-white font-orbitron mb-6">JOIN THE RESISTANCE</h2>
            <p class="text-xl text-gray-300 mb-10 max-w-3xl mx-auto">
                Ready to dive into the neon-lit streets of our cyberpunk world? Register now to join our community and start your adventure.
            </p>
            <div class="inline-block">
                <a href="{{ route('register') }}" class="cyber-button text-lg px-8 py-4">
                    CREATE YOUR IDENTITY
                </a>
            </div>
        </div>
    </section>
</x-layouts.cyberpunk>