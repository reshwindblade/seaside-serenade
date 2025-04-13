<!-- resources/views/cyberpunk/recaps.blade.php -->
<x-layouts.cyberpunk>
    <!-- Header -->
    <section class="relative py-16 bg-black bg-opacity-70">
        <div class="absolute inset-0 cyber-grid opacity-10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold font-orbitron text-white mb-4 text-center">ADVENTURE <span class="neon-text-green">RECAPS</span></h1>
            <p class="text-gray-300 text-center max-w-3xl mx-auto">
                Catch up on previous sessions and follow the story of our cyberpunk campaign.
            </p>
        </div>
    </section>
    
    @if($recaps->isEmpty())
        <!-- Coming Soon Section -->
        <section class="py-24">
            <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
                <div class="cyber-border p-8 rounded-lg bg-black bg-opacity-60 cyber-grid">
                    <h2 class="text-3xl font-bold font-orbitron text-white mb-6">COMING SOON</h2>
                    <p class="text-gray-300 text-lg mb-8">
                        Adventure recaps will be available after our first session. Stay tuned for updates on our cyberpunk campaign!
                    </p>
                    <div class="inline-block">
                        <a href="{{ route('home') }}" class="cyber-button">
                            RETURN HOME
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @else
        <!-- Recaps Timeline -->
        <section class="py-16">
            <div class="max-w-4xl mx-auto px-6 lg:px-8">
                <div class="relative border-l-2 border-green-500 ml-3 md:ml-6 pl-8 py-6">
                    <!-- Glowing effect on the timeline -->
                    <div class="absolute top-0 bottom-0 left-0 w-[2px] bg-green-500 blur-[5px] -ml-[2px]"></div>
                    
                    @foreach($recaps as $recap)
                        <div 
                            class="mb-16 relative"
                            x-data="{ showModal: false }"
                        >
                            <!-- Timeline dot with glow -->
                            <div class="absolute left-0 w-6 h-6 bg-green-500 rounded-full -ml-[19px] mt-1.5 flex items-center justify-center">
                                <div class="absolute w-6 h-6 bg-green-500 rounded-full blur-[5px] opacity-70"></div>
                                <div class="w-2 h-2 bg-white rounded-full z-10"></div>
                            </div>
                            
                            <!-- Date -->
                            <div class="mb-2 flex items-center">
                                <span class="text-green-400 font-mono">{{ $recap->session_date->format('Y.m.d') }}</span>
                                <span class="ml-3 px-2 py-1 bg-black bg-opacity-50 border border-green-500 text-white text-xs">
                                    SESSION {{ $recap->session_number }}
                                </span>
                            </div>
                            
                            <!-- Recap content preview -->
                            <div class="cyber-card p-6 hover:border-green-500 transition-colors duration-300 cursor-pointer" @click="showModal = true">
                                <h3 class="text-xl font-bold text-white font-orbitron mb-3">{{ $recap->title }}</h3>
                                <div class="text-gray-400 line-clamp-3">
                                    {{ $recap->summary }}
                                </div>
                                <div class="mt-4 flex justify-end">
                                    <span class="text-green-400 text-sm hover:underline">Read Full Recap</span>
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
                                <div class="cyber-border relative w-full max-w-4xl max-h-[90vh] overflow-y-auto bg-black p-8 rounded-lg cyber-grid" @click.stop>
                                    <div class="absolute top-3 right-3">
                                        <button @click="showModal = false" class="text-gray-400 hover:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    
                                    <div class="mb-6 flex items-center justify-between">
                                        <div>
                                            <span class="inline-block px-2 py-1 bg-black bg-opacity-50 border border-green-500 text-white text-xs">
                                                SESSION {{ $recap->session_number }}
                                            </span>
                                            <span class="ml-2 text-green-400 font-mono">{{ $recap->session_date->format('Y.m.d') }}</span>
                                        </div>
                                        <div class="text-sm text-gray-400">
                                            @if($recap->creator)
                                                Recapped by {{ $recap->creator->name }}
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <h3 class="text-2xl font-bold text-white font-orbitron mb-4">{{ $recap->title }}</h3>
                                    
                                    <div class="prose prose-invert prose-green max-w-none">
                                        {!! $recap->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.cyberpunk>