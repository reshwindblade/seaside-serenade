<!-- resources/views/cyberpunk/powers.blade.php -->
<x-layouts.cyberpunk>
    <!-- Header -->
    <section class="relative py-16 bg-black bg-opacity-70">
        <div class="absolute inset-0 cyber-grid opacity-10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold font-orbitron text-white mb-4 text-center">POWERS <span class="neon-text-blue">&</span> <span class="neon-text-pink">ABILITIES</span></h1>
            <p class="text-gray-300 text-center max-w-3xl mx-auto">
                Explore the extraordinary cybernetic enhancements, tech abilities, and special powers available in our campaign.
            </p>
        </div>
    </section>
    
    <!-- Coming Soon Section -->
    <section class="py-24">
        <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <div class="cyber-border p-8 rounded-lg bg-black bg-opacity-60 cyber-grid">
                <div class="relative mb-10">
                    <div class="relative inline-block">
                        <div class="absolute inset-0 blur-xl bg-blue-500 opacity-30 rounded-full"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-blue-500 relative" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
                
                <h2 class="text-3xl font-bold font-orbitron text-white mb-6">COMING SOON</h2>
                <p class="text-gray-300 text-lg mb-8 max-w-2xl mx-auto">
                    Our development team is working on compiling a comprehensive database of all cybernetic enhancements, netrunner abilities, and special powers available in our game. This section will be accessible in a future update.
                </p>
                
                <div class="mb-8 flex justify-center items-center">
                    <div class="h-1 w-40 bg-pink-500 relative">
                        <div class="absolute h-full w-12 bg-blue-500 animate-[loading_2s_ease-in-out_infinite]"></div>
                    </div>
                </div>
                
                <div class="inline-block">
                    <a href="{{ route('home') }}" class="cyber-button">
                        RETURN HOME
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Teaser Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h2 class="text-3xl font-bold font-orbitron text-white mb-10 text-center">SNEAK <span class="neon-text-pink">PEEK</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="cyber-card p-6 opacity-70 hover:opacity-100 transition-opacity duration-300">
                    <div class="mb-4 flex justify-center">
                        <div class="h-16 w-16 rounded-full border border-blue-500 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-white font-orbitron mb-2 text-center">NETRUNNING</h3>
                    <p class="text-gray-400 text-center">
                        Navigate the digital realm, hack secure systems, and manipulate data to gain advantages in the physical world.
                    </p>
                </div>
                
                <div class="cyber-card p-6 opacity-70 hover:opacity-100 transition-opacity duration-300">
                    <div class="mb-4 flex justify-center">
                        <div class="h-16 w-16 rounded-full border border-pink-500 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-white font-orbitron mb-2 text-center">CYBERNETICS</h3>
                    <p class="text-gray-400 text-center">
                        Enhance your body with cutting-edge implants and modifications to gain superhuman abilities.
                    </p>
                </div>
                
                <div class="cyber-card p-6 opacity-70 hover:opacity-100 transition-opacity duration-300">
                    <div class="mb-4 flex justify-center">
                        <div class="h-16 w-16 rounded-full border border-purple-500 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-white font-orbitron mb-2 text-center">PSIONICS</h3>
                    <p class="text-gray-400 text-center">
                        Unlock the hidden potential of the human mind with experimental tech and push beyond normal mental limitations.
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <style>
        @keyframes loading {
            0% { left: 0; }
            50% { left: calc(100% - 3rem); }
            100% { left: 0; }
        }
    </style>
</x-layouts.cyberpunk>