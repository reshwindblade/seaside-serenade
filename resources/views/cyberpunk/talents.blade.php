<!-- resources/views/cyberpunk/talents.blade.php -->
<x-layouts.cyberpunk>
    <!-- Header -->
    <section class="relative py-16 bg-black bg-opacity-70">
        <div class="absolute inset-0 cyber-grid opacity-10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold font-orbitron text-white mb-4 text-center">UNIQUE <span class="neon-text-green">TALENTS</span></h1>
            <p class="text-gray-300 text-center max-w-3xl mx-auto">
                Special skills, expertise, and extraordinary capabilities that set characters apart in the unforgiving cyberpunk world.
            </p>
            
            <!-- Category Filter -->
            <div class="mt-10 flex flex-wrap justify-center gap-2">
                <a href="{{ route('talents') }}" class="py-2 px-4 border {{ !$category ? 'border-green-500 text-green-400' : 'border-gray-700 text-gray-400 hover:border-green-500 hover:text-green-400' }} transition-colors duration-200">
                    All Talents
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('talents', ['category' => $cat]) }}" class="py-2 px-4 border {{ $category === $cat ? 'border-green-500 text-green-400' : 'border-gray-700 text-gray-400 hover:border-green-500 hover:text-green-400' }} transition-colors duration-200">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    
    <!-- Talents Grid -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if($talents->isEmpty())
                <div class="text-center py-16">
                    <p class="text-gray-400 text-lg">No talents found in this category.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($talents as $talent)
                        <div 
                            x-data="{ expanded: false }"
                            class="cyber-card relative group cursor-pointer"
                        >
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-xl font-bold text-white font-orbitron">{{ $talent->name }}</h3>
                                    <span class="px-3 py-1 {{ $talent->power_rating >= 0 ? 'bg-green-900/30 border-green-500 text-green-400' : 'bg-red-900/30 border-red-500 text-red-400' }} border rounded-full text-xs">
                                        {{ $talent->power_rating >= 0 ? '+' : '' }}{{ $talent->power_rating }}
                                    </span>
                                </div>
                                
                                <div class="mb-4 line-clamp-3 text-gray-400">
                                    <strong class="text-gray-300">Category:</strong> {{ $talent->category }}
                                </div>
                                
                                <div class="mt-4 flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        Talent
                                    </div>
                                    
                                    <button 
                                        @click="expanded = !expanded"
                                        class="text-green-400 text-sm flex items-center group-hover:underline"
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
                                    @if($talent->description)
                                    <div class="prose prose-invert prose-sm max-w-none text-gray-300">
                                        {!! Str::markdown($talent->description) !!}
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