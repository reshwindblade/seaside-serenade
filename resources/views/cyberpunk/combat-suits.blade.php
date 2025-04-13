<!-- resources/views/cyberpunk/combat-suits.blade.php -->
<x-layouts.cyberpunk>
    <!-- Header -->
    <section class="relative py-16 bg-black bg-opacity-70">
        <div class="absolute inset-0 cyber-grid opacity-10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold font-orbitron text-white mb-4 text-center">COMBAT <span class="neon-text-blue">SUITS</span></h1>
            <p class="text-gray-300 text-center max-w-3xl mx-auto">
                Advanced technological armor systems designed to enhance combat effectiveness and provide tactical advantages in the field.
            </p>
        </div>
    </section>
    
    <!-- Combat Suits Grid -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if($suits->isEmpty())
                <div class="text-center py-16">
                    <p class="text-gray-400 text-lg">No combat suits available. Check back later.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($suits as $suit)
                        <div 
                            x-data="{ expanded: false }"
                            class="cyber-card relative group cursor-pointer"
                        >
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-xl font-bold text-white font-orbitron">{{ $suit->name }}</h3>
                                    <span class="px-3 py-1 bg-blue-900/30 border border-blue-500 text-blue-400 rounded-full text-xs">
                                        Power: {{ $suit->power_rating }}
                                    </span>
                                </div>
                                
                                <div class="mb-4 line-clamp-3 text-gray-400">
                                    {{ Str::limit(strip_tags($suit->description), 150) }}
                                </div>
                                
                                <div class="mt-4 flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        {{ $suit->effects->count() }} Effects
                                    </div>
                                    
                                    <button 
                                        @click="expanded = !expanded"
                                        class="text-blue-400 text-sm flex items-center group-hover:underline"
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
                                    <h4 class="text-md font-semibold text-blue-400 mb-2">Effects</h4>
                                    <div class="space-y-2">
                                        @foreach($suit->effects as $effect)
                                        <div class="bg-gray-900/50 p-3 rounded-lg">
                                            <div class="flex justify-between items-center">
                                                <span class="text-white">{{ $effect->name }}</span>
                                                <span class="text-sm {{ $effect->power_rating >= 0 ? 'text-green-400' : 'text-red-400' }}">
                                                    {{ $effect->power_rating >= 0 ? '+' : '' }}{{ $effect->power_rating }}
                                                </span>
                                            </div>
                                            @if($effect->description)
                                            <p class="text-xs text-gray-400 mt-1">{{ $effect->description }}</p>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-layouts.cyberpunk>