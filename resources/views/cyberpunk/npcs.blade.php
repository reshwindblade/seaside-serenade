<!-- resources/views/cyberpunk/npcs.blade.php -->
<x-layouts.cyberpunk>
    <!-- Header -->
    <section class="relative py-16 bg-black bg-opacity-70">
        <div class="absolute inset-0 cyber-grid opacity-10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold font-orbitron text-white mb-4 text-center">NON-PLAYER <span class="neon-text-pink">CHARACTERS</span></h1>
            <p class="text-gray-300 text-center max-w-3xl mx-auto">
                Meet the diverse cast of NPCs that populate our cyberpunk world - from corporate executives and street gang leaders to rogue AI and underground hackers.
            </p>
        </div>
    </section>
    
    <!-- NPCs Cards -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if($npcs->isEmpty())
                <div class="text-center py-16">
                    <p class="text-gray-400 text-lg">No NPCs found. Check back later.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($npcs as $npc)
                        <div 
                            class="cyber-card relative group cursor-pointer overflow-hidden"
                            x-data="{ showModal: false }"
                            @click="showModal = true"
                        >
                            <div class="relative aspect-[3/4] overflow-hidden">
                                <img 
                                    src="{{ $npc->imageUrl }}" 
                                    alt="{{ $npc->name }}" 
                                    class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-110"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-6">
                                    <h3 class="text-2xl font-bold text-white font-orbitron mb-1">{{ $npc->name }}</h3>
                                    @if($npc->title)
                                        <p class="text-blue-400 mb-3">{{ $npc->title }}</p>
                                    @endif
                                    <div class="mt-2 flex justify-end">
                                        <span class="text-blue-400 text-sm group-hover:underline">Learn More</span>
                                    </div>
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
                                <div class="cyber-border relative w-full max-w-4xl max-h-[90vh] overflow-y-auto bg-black rounded-lg flex flex-col md:flex-row cyber-grid" @click.stop>
                                    <div class="absolute top-3 right-3 z-10">
                                        <button @click="showModal = false" class="text-gray-400 hover:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    
                                    <div class="md:w-1/3 relative">
                                        <img 
                                            src="{{ $npc->imageUrl }}" 
                                            alt="{{ $npc->name }}" 
                                            class="w-full h-full object-cover object-center md:h-auto md:max-h-[80vh]"
                                        >
                                    </div>
                                    
                                    <div class="md:w-2/3 p-8">
                                        <h3 class="text-2xl font-bold text-white font-orbitron mb-1">{{ $npc->name }}</h3>
                                        @if($npc->title)
                                            <p class="text-blue-400 mb-4">{{ $npc->title }}</p>
                                        @endif
                                        
                                        <div class="prose prose-invert prose-blue max-w-none">
                                            {!! $npc->description !!}
                                        </div>
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