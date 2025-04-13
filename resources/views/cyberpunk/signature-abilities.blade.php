<!-- resources/views/cyberpunk/signature-abilities.blade.php -->
<x-layouts.cyberpunk>
    <!-- Header -->
    <section class="relative py-16 bg-black bg-opacity-70">
        <div class="absolute inset-0 cyber-grid opacity-10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold font-orbitron text-white mb-4 text-center">SIGNATURE <span class="neon-text-pink">ABILITIES</span></h1>
            <p class="text-gray-300 text-center max-w-3xl mx-auto">
                Unique, game-changing powers that define a character's extraordinary capabilities in the high-stakes world of cyberpunk.
            </p>
        </div>
    </section>
    
    <!-- Signature Abilities Grid -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if($abilities->isEmpty())
                <div class="text-center py-16">
                    <p class="text-gray-400 text-lg">No signature abilities available. Check back later.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($abilities as $ability)
                        <div 
                            x-data="{ expanded: false }"
                            class="cyber-card relative group cursor-pointer"
                        >
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-xl font-bold text-white font-orbitron">{{ $ability->name }}</h3>
                                    <span class="px-3 py-1 {{ $ability->power_rating >= 0 ? 'bg-pink-900/30 border-pink-500 text-pink-400' : 'bg-red-900/30 border-red-500 text-red-400' }} border rounded-full text-xs">
                                        {{ $ability->power_rating >= 0 ? '+' : '' }}{{ $ability->power_rating }}
                                    </span>
                                </div>
                                
                                @if($ability->cooldown)
                                <div class="mb-4 text-gray-400">
                                    <strong class="text-gray-300">Cooldown:</strong> {{ $ability->cooldown }}
                                </div>
                                @endif
                                
                                <div class="mt-4 flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        Signature Ability
                                    </div>
                                    
                                    <button 
                                        @click="expanded = !expanded"
                                        class="text-pink-400 text-sm flex items-center group-hover:underline"
                                    >
                                        {{ $expanded ? 'Hide Details' : 'View Details' }}
                                        <svg 
                                            :class="{'rotate-180': expanded}"
                                            class="w-4 h-4 ml-1 transition-transform" 
                                            fill="none" 
                                            viewBox="0 0 24 24" 
                                            stroke="currentColor"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </div>
                                
                                <div 
                                    x-show="expanded" 
                                    x-collapse 
                                    class="mt-4 border-t border-gray-700 pt-4"
                                >
                                    @if($ability->effect)
                                    <div class="prose prose-invert prose-sm max-w-none text-gray-300">
                                        {!! Str::markdown($ability->effect) !!}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-layouts.cyberpunk>