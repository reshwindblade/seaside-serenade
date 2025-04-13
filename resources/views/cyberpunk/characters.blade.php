<x-layouts.cyberpunk>
    <!-- Header -->
    <section class="relative py-16 bg-black bg-opacity-70">
        <div class="absolute inset-0 cyber-grid opacity-10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold font-orbitron text-white mb-4 text-center">PLAYER <span class="neon-text-yellow">CHARACTERS</span></h1>
            <p class="text-gray-300 text-center max-w-3xl mx-auto">
                Meet the main protagonists of our cyberpunk adventure - runners, hackers, and mercenaries fighting for survival in a dystopian future.
            </p>
        </div>
    </section>
    
    <!-- Character Cards -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if($characters->isEmpty())
                <div class="text-center py-16">
                    <p class="text-gray-400 text-lg">No characters found. Check back later.</p>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    @foreach($characters as $character)
                        <div class="cyber-card relative group cursor-pointer overflow-hidden flex flex-col md:flex-row transform transition-all duration-300 hover:-translate-y-2">
                            <div class="md:w-2/5 relative">
                                <img 
                                    src="{{ $character->imageUrl }}" 
                                    alt="{{ $character->name }}" 
                                    class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-110 md:h-auto md:max-h-[300px]"
                                >
                                <div class="absolute bottom-0 right-0 m-2 px-2 py-1 bg-black bg-opacity-75 text-white text-xs">
                                    Played by {{ $character->player_name }}
                                </div>
                            </div>
                            
                            <div class="md:w-3/5 p-6">
                                <h3 class="text-2xl font-bold text-white font-orbitron mb-2">{{ $character->name }}</h3>
                                <div class="mb-4 line-clamp-4 text-gray-400">
                                    {{ Str::limit(strip_tags($character->description), 150) }}
                                </div>
                                <div class="mt-4 flex justify-between items-center">
                                    @if($character->combatSuit || $character->signatureAbility)
                                    <div class="flex flex-wrap gap-2">
                                        @if($character->combatSuit)
                                        <span class="px-2 py-1 text-xs font-medium bg-blue-900/30 text-blue-400 border border-blue-500 rounded-full">
                                            {{ $character->combatSuit->name }}
                                        </span>
                                        @endif
                                        
                                        @if($character->signatureAbility)
                                        <span class="px-2 py-1 text-xs font-medium bg-pink-900/30 text-pink-400 border border-pink-500 rounded-full">
                                            {{ $character->signatureAbility->name }}
                                        </span>
                                        @endif
                                    </div>
                                    @endif
                                    
                                    <a href="{{ route('characters.show', $character->id) }}" class="text-blue-400 text-sm flex items-center group-hover:underline">
                                        View Character
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-layouts.cyberpunk>