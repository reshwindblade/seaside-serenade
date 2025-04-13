<!-- resources/views/cyberpunk/rules.blade.php -->
<x-layouts.cyberpunk>
    <!-- Header -->
    <section class="relative py-16 bg-black bg-opacity-70">
        <div class="absolute inset-0 cyber-grid opacity-10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold font-orbitron text-white mb-4 text-center">RULES <span class="neon-text-blue">&</span> HOW TO PLAY</h1>
            <p class="text-gray-300 text-center max-w-3xl mx-auto">
                Everything you need to know about playing in our Cyberpunk RPG campaign.
            </p>
            
            <!-- Category Filter -->
            <div class="mt-10 flex flex-wrap justify-center gap-2">
                <a href="{{ route('rules') }}" class="py-2 px-4 border {{ !$category ? 'border-blue-500 text-blue-400' : 'border-gray-700 text-gray-400 hover:border-blue-500 hover:text-blue-400' }} transition-colors duration-200">
                    All Rules
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('rules', ['category' => $cat]) }}" class="py-2 px-4 border {{ $category === $cat ? 'border-blue-500 text-blue-400' : 'border-gray-700 text-gray-400 hover:border-blue-500 hover:text-blue-400' }} transition-colors duration-200">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    
    <!-- Rules Cards -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if($rules->isEmpty())
                <div class="text-center py-16">
                    <p class="text-gray-400 text-lg">No rules found for this category. Check back later.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($rules as $rule)
                        <div 
                            class="cyber-card relative group cursor-pointer"
                            x-data="{ showModal: false }"
                            @click="showModal = true"
                        >
                            <div class="p-6">
                                <div class="mb-4 flex justify-between items-start">
                                    <span class="inline-block py-1 px-3 text-xs border border-blue-500 text-blue-400">
                                        {{ $rule->category }}
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-white font-orbitron mb-2">{{ $rule->name }}</h3>
                                <p class="text-gray-400 line-clamp-3">
                                    {{ Str::limit(strip_tags($rule->description), 100) }}
                                </p>
                                <div class="mt-4 flex justify-end">
                                    <span class="text-blue-400 text-sm group-hover:underline">Read More</span>
                                </div>
                            </div>
                            
                            <!-- Modal -->
                            <div
                                x-show="showModal"
                                x-cloak
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-90"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-90"
                                @click.away="showModal = false"
                                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-80"
                            >
                                <div class="cyber-border relative w-full max-w-3xl max-h-[80vh] overflow-y-auto bg-black p-8 rounded-lg cyber-grid" @click.stop>
                                    <div class="absolute top-3 right-3">
                                        <button @click="showModal = false" class="text-gray-400 hover:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <span class="inline-block py-1 px-3 text-xs border border-blue-500 text-blue-400 mb-2">
                                            {{ $rule->category }}
                                        </span>
                                        <h3 class="text-2xl font-bold text-white font-orbitron">{{ $rule->name }}</h3>
                                    </div>
                                    
                                    <div class="prose prose-invert prose-blue max-w-none">
                                        {!! $rule->description !!}
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