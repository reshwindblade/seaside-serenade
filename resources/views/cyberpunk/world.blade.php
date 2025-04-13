<!-- resources/views/cyberpunk/world.blade.php -->
<x-layouts.cyberpunk>
    <!-- Header -->
    <section class="relative py-16 bg-black bg-opacity-70">
        <div class="absolute inset-0 cyber-grid opacity-10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold font-orbitron text-white mb-4 text-center">WORLD <span class="neon-text-purple">SETTING</span></h1>
            <p class="text-gray-300 text-center max-w-3xl mx-auto">
                Dive into the rich lore and detailed history of our cyberpunk universe.
            </p>
        </div>
    </section>
    
    <!-- World Setting Content -->
    <section class="py-16">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <div class="cyber-border p-8 rounded-lg bg-black bg-opacity-60 cyber-grid">
                <div class="prose prose-invert prose-purple prose-lg max-w-none">
                    {!! Str::markdown($world->content) !!}
                </div>
                
                <div class="mt-8 text-right">
                    <p class="text-sm text-gray-400">
                        @if($world->last_updated_by)
                            Last updated by {{ $world->lastUpdatedBy->name }} on {{ $world->updated_at->format('F j, Y') }}
                        @else
                            Last updated on {{ $world->updated_at->format('F j, Y') }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- City Map Section (optional) -->
    <section class="py-16 bg-black bg-opacity-60">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h2 class="text-3xl font-bold font-orbitron text-white mb-8 text-center">CITY <span class="neon-text-blue">MAP</span></h2>
            
            <div class="relative aspect-[16/9] cyber-border rounded-lg overflow-hidden">
                <div class="absolute inset-0 cyber-grid opacity-20"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <p class="text-blue-400 text-lg">Interactive map coming soon...</p>
                </div>
            </div>
            
            <div class="mt-8 text-center">
                <p class="text-gray-400">
                    Our interactive city map is currently in development. Check back soon to explore the urban sprawl of our cyberpunk metropolis.
                </p>
            </div>
        </div>
    </section>
</x-layouts.cyberpunk>