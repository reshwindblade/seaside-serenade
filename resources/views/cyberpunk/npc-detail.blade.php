<!-- resources/views/cyberpunk/npc-detail.blade.php -->
<x-layouts.cyberpunk>
    <!-- Header with NPC Name -->
    <section class="relative py-16 bg-black bg-opacity-70">
        <div class="absolute inset-0 cyber-grid opacity-10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold font-orbitron text-white mb-4 text-center">{{ $npc->name }}</h1>
            @if($npc->title)
            <p class="text-pink-400 text-center text-xl max-w-3xl mx-auto font-orbitron">
                {{ $npc->title }}
            </p>
            @endif
        </div>
    </section>
    
    <!-- NPC Profile -->
    <section class="py-12">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- NPC Image -->
                <div class="md:w-1/3">
                    <div class="cyber-border rounded-lg overflow-hidden">
                        <img src="{{ $npc->imageUrl }}" alt="{{ $npc->name }}" class="w-full h-auto object-cover">
                    </div>
                </div>
                
                <!-- NPC Description -->
                <div class="md:w-2/3">
                    <div class="cyber-border p-6 rounded-lg bg-black bg-opacity-60 cyber-grid h-full">
                        <div class="prose prose-invert prose-pink prose-lg max-w-none">
                            {!! Str::markdown($npc->description) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Connections (Optional for future expansion) -->
    <!--
    <section class="py-12 bg-black bg-opacity-60">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <h2 class="text-3xl font-bold font-orbitron text-white mb-8 text-center">
                <span class="neon-text-blue">CONNECTIONS</span> & <span class="neon-text-pink">HISTORY</span>
            </h2>
            
            <!-- Connections content would go here -->
    <!--
        </div>
    </section>
    -->
    
    <!-- Back to NPCs Button -->
    <div class="py-12 text-center">
        <a href="{{ route('npcs') }}" class="cyber-button inline-block">
            BACK TO NPCs
        </a>
    </div>
</x-layouts.cyberpunk>