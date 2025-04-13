<!-- resources/views/cyberpunk/short-stories.blade.php -->
<x-layouts.cyberpunk>
    <!-- Header -->
    <section class="relative py-16 bg-black bg-opacity-70">
        <div class="absolute inset-0 cyber-grid opacity-10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold font-orbitron text-white mb-4 text-center">CHARACTER <span class="neon-text-purple">SHORT STORIES</span></h1>
            <p class="text-gray-300 text-center max-w-3xl mx-auto">
                Intimate glimpses into the personal narratives that shape our characters' lives in the dark, complex world of cyberpunk.
            </p>
        </div>
    </section>
    
    <!-- Short Stories -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if($stories->isEmpty())
                <div class="text-center py-16">
                    <p class="text-gray-400 text-lg">No short stories available. Check back later.</p>
                </div>
            @else
                <div class="space-y-8">
                    @foreach($stories as $story)
                        <div 
                            x-data="{ expanded: false }"
                            class="cyber-card"
                        >
                            <div 
                                @click="expanded = !expanded" 
                                class="p-6 cursor-pointer flex justify-between items-center"
                            >
                                <div class="flex-grow">
                                    <div class="flex justify-between items-center mb-2">
                                        <h3 class="text-xl font-bold text-white font-orbitron">{{ $story->title }}</h3>
                                        @if($story->story_date)
                                        <span class="text-sm text-purple-400">
                                            {{ $story->story_date->format('M d, Y') }}
                                        </span>
                                        @endif
                                    </div>
                                    
                                    @if($story->character)
                                    <p class="text-gray-400 text-sm">
                                        Character: {{ $story->character->name }}
                                    </p>
                                    @endif
                                </div>
                                
                                <svg 
                                    :class="{'rotate-180': expanded}"
                                    class="w-5 h-5 text-purple-400 transform transition-transform duration-200 ml-4" 
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
                                <div class="prose prose-invert prose-purple max-w-none text-gray-300">
                                    {!! Str::markdown($story->content) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-layouts.cyberpunk>