<!-- resources/views/cyberpunk/weaknesses.blade.php -->
<x-layouts.cyberpunk>
    <!-- Header -->
    <section class="relative py-16 bg-black bg-opacity-70">
        <div class="absolute inset-0 cyber-grid opacity-10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold font-orbitron text-white mb-4 text-center">CHARACTER <span class="neon-text-red">WEAKNESSES</span></h1>
            <p class="text-gray-300 text-center max-w-3xl mx-auto">
                The vulnerabilities and limitations that challenge characters, adding depth and complexity to their journey in the unforgiving cyberpunk world.
            </p>
        </div>
    </section>
    
    <!-- Weaknesses Grid -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if($weaknesses->isEmpty())
                <div class="text-center py-16">
                    <p class="text-gray-400 text-lg">No weaknesses found. Check back later.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($weaknesses as $weakness)
                        <div 
                            x-data="{ expanded: false }"
                            class="cyber-card"
                        >
                            <div 
                                @click="expanded = !expanded" 
                                class="p-6 cursor-pointer flex justify-between items-center"
                            >
                                <div class="flex items-center">
                                    <h3 class="text-xl font-bold text-white font-orbitron mr-4">{{ $weakness->name }}</h3>
                                    <span class="px-3 py-1 bg-red-900/30 border border-red-500 text-red-400 rounded-full text-xs">
                                        {{ $weakness->power_rating }}
                                    </span>
                                </div>
                                
                                <svg 
                                    :class="{'rotate-180': expanded}"
                                    class="w-5 h-5 text-red-400 transform transition-transform duration-200" 
                                    fill="none" 
                                    viewBox="0 0 24 24" 
                                    stroke="currentColor"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            
                            <div 
                                x-show="expanded"
                                x-collapse
                                class="border-t border-gray-700 p-6"
                            >
                                @if($weakness->description)
                                <div class="prose prose-invert prose-sm max-w-none text-gray-300">
                                    {!! Str::markdown($weakness->description) !!}
                                </div>
                                @else
                                <p class="text-gray-400 italic">No additional details available.</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-layouts.cyberpunk>