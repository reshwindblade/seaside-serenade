<!-- resources/views/cyberpunk/character-detail.blade.php -->
<x-layouts.cyberpunk>
    <!-- Header with Character Name -->
    <section class="relative py-16 bg-black bg-opacity-70">
        <div class="absolute inset-0 cyber-grid opacity-10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold font-orbitron text-white mb-4 text-center">{{ $character->name }}</h1>
            <p class="text-gray-300 text-center max-w-3xl mx-auto">
                Played by {{ $character->player_name }}
            </p>
            <div class="flex justify-center mt-4">
                <span class="px-3 py-1 bg-blue-900/30 border border-blue-500 text-blue-400 rounded-full text-sm">
                    Power Rating: {{ $character->total_power_rating }}
                </span>
            </div>
        </div>
    </section>
    
    <!-- Character Profile -->
    <section class="py-12">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Character Image -->
                <div class="md:w-1/3">
                    <div class="cyber-border rounded-lg overflow-hidden">
                        <img src="{{ $character->imageUrl }}" alt="{{ $character->name }}" class="w-full h-auto object-cover">
                    </div>
                </div>
                
                <!-- Character Description -->
                <div class="md:w-2/3">
                    <div class="cyber-border p-6 rounded-lg bg-black bg-opacity-60 cyber-grid h-full">
                        <div class="prose prose-invert prose-purple prose-lg max-w-none">
                            {!! Str::markdown($character->description) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Character Abilities Section -->
    <section class="py-12 bg-black bg-opacity-60">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <h2 class="text-3xl font-bold font-orbitron text-white mb-8 text-center">
                <span class="neon-text-blue">ABILITIES</span> & <span class="neon-text-pink">EQUIPMENT</span>
            </h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Signature Ability -->
                @if($character->signatureAbility)
                <div 
                    x-data="{ open: true }"
                    class="cyber-card"
                >
                    <div @click="open = !open" class="flex items-center justify-between p-6 cursor-pointer border-b border-blue-500">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <h3 class="text-xl font-bold text-white font-orbitron">Signature Ability</h3>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3 text-sm text-blue-400">Power: {{ $character->signatureAbility->power_rating }}</span>
                            <svg 
                                :class="{'rotate-180': open}" 
                                class="w-5 h-5 text-blue-400 transform transition-transform duration-200" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <div x-show="open" class="p-6">
                        <div class="mb-4">
                            <h4 class="text-lg font-orbitron text-blue-400 mb-2">{{ $character->signatureAbility->name }}</h4>
                            <div class="prose prose-invert prose-sm max-w-none">
                                {!! Str::markdown($character->signatureAbility->effect) !!}
                            </div>
                        </div>
                        @if($character->signatureAbility->cooldown)
                        <div class="mt-4 text-sm text-gray-400">
                            <span class="font-semibold text-pink-400">Cooldown:</span> {{ $character->signatureAbility->cooldown }}
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                
                <!-- Combat Suit -->
                @if($character->combatSuit)
                <div 
                    x-data="{ open: true }"
                    class="cyber-card"
                >
                    <div @click="open = !open" class="flex items-center justify-between p-6 cursor-pointer border-b border-blue-500">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <h3 class="text-xl font-bold text-white font-orbitron">Combat Suit</h3>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3 text-sm text-blue-400">Power: {{ $character->combatSuit->power_rating }}</span>
                            <svg 
                                :class="{'rotate-180': open}" 
                                class="w-5 h-5 text-blue-400 transform transition-transform duration-200" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <div x-show="open" class="p-6">
                        <div class="mb-4">
                            <h4 class="text-lg font-orbitron text-blue-400 mb-2">{{ $character->combatSuit->name }}</h4>
                            @if($character->combatSuit->description)
                            <div class="prose prose-invert prose-sm max-w-none mb-4">
                                {!! Str::markdown($character->combatSuit->description) !!}
                            </div>
                            @endif
                        </div>
                        
                        @if($character->combatSuit->effects->isNotEmpty())
                        <div class="mt-4">
                            <h5 class="text-md font-orbitron text-pink-400 mb-2">Effects</h5>
                            <div class="space-y-2">
                                @foreach($character->combatSuit->effects as $effect)
                                <div class="flex justify-between items-center p-3 border border-gray-800 rounded-lg bg-gray-900/50">
                                    <div>
                                        <span class="font-medium text-white">{{ $effect->name }}</span>
                                        @if($effect->description)
                                        <p class="text-sm text-gray-400 mt-1">{{ $effect->description }}</p>
                                        @endif
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm {{ $effect->power_rating >= 0 ? 'text-green-400' : 'text-red-400' }}">
                                            {{ $effect->power_rating >= 0 ? '+' : '' }}{{ $effect->power_rating }}
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Talents -->
            @if($talentCategories->isNotEmpty())
            <div class="mt-12">
                <h3 class="text-2xl font-bold font-orbitron text-white mb-6 text-center">
                    <span class="neon-text-green">TALENTS</span>
                </h3>
                
                <div 
                    x-data="{ activeCategory: '{{ $talentCategories->keys()->first() }}' }"
                    class="cyber-border bg-black bg-opacity-80 rounded-lg p-6"
                >
                    <!-- Category Tabs -->
                    <div class="flex flex-wrap gap-2 mb-6 justify-center">
                        @foreach($talentCategories as $category => $talents)
                        <button 
                            @click="activeCategory = '{{ $category }}'"
                            :class="{ 'bg-green-900 border-green-500 text-green-400': activeCategory === '{{ $category }}', 'bg-transparent border-gray-700 text-gray-400 hover:text-green-400 hover:border-green-400': activeCategory !== '{{ $category }}' }"
                            class="px-4 py-2 rounded-full border transition-colors duration-200"
                        >
                            {{ $category }}
                        </button>
                        @endforeach
                    </div>
                    
                    <!-- Talent Lists by Category -->
                    @foreach($talentCategories as $category => $talents)
                    <div x-show="activeCategory === '{{ $category }}'" class="grid gap-4 grid-cols-1 md:grid-cols-2">
                        @foreach($talents as $talent)
                        <div class="flex justify-between items-start p-4 border border-gray-800 rounded-lg bg-gray-900/50">
                            <div>
                                <h4 class="text-md font-medium text-green-400">{{ $talent->name }}</h4>
                                @if($talent->description)
                                <div class="prose prose-invert prose-sm mt-2">
                                    {!! Str::markdown($talent->description) !!}
                                </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <span class="inline-block px-2 py-1 bg-green-900/50 border border-green-500 rounded-full text-xs text-green-400">
                                    {{ $talent->power_rating >= 0 ? '+' : '' }}{{ $talent->power_rating }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            
            <!-- Weaknesses -->
            @if($character->weaknesses->isNotEmpty())
            <div class="mt-12">
                <h3 class="text-2xl font-bold font-orbitron text-white mb-6 text-center">
                    <span class="neon-text-red">WEAKNESSES</span>
                </h3>
                
                <div class="cyber-border bg-black bg-opacity-80 rounded-lg">
                    <div class="divide-y divide-gray-800">
                        @foreach($character->weaknesses as $weakness)
                        <div 
                            x-data="{ open: false }"
                            class="cursor-pointer"
                        >
                            <div @click="open = !open" class="flex justify-between items-center p-4 hover:bg-gray-900/50">
                                <h4 class="text-md font-medium text-red-400">{{ $weakness->name }}</h4>
                                <div class="flex items-center">
                                    <span class="mr-3 inline-block px-2 py-1 bg-red-900/50 border border-red-500 rounded-full text-xs text-red-400">
                                        {{ $weakness->power_rating }}
                                    </span>
                                    <svg 
                                        :class="{'rotate-180': open}" 
                                        class="w-5 h-5 text-red-400 transform transition-transform duration-200" 
                                        fill="none" 
                                        viewBox="0 0 24 24" 
                                        stroke="currentColor"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            @if($weakness->description)
                            <div x-show="open" class="p-4 bg-gray-900/30">
                                <div class="prose prose-invert prose-sm">
                                    {!! Str::markdown($weakness->description) !!}
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    
    <!-- Short Stories Section -->
    @if($character->shortStories->isNotEmpty())
    <section class="py-12">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <h2 class="text-3xl font-bold font-orbitron text-white mb-8 text-center">
                <span class="neon-text-purple">SHORT STORIES</span>
            </h2>
            
            <div class="space-y-8">
                @foreach($character->shortStories as $story)
                <div 
                    x-data="{ open: false }"
                    class="cyber-card"
                >
                    <div @click="open = !open" class="flex justify-between items-center p-6 cursor-pointer border-b border-purple-500">
                        <div>
                            <h3 class="text-xl font-bold text-white font-orbitron">{{ $story->title }}</h3>
                            @if($story->story_date)
                            <p class="text-sm text-purple-400 mt-1">{{ $story->story_date->format('F j, Y') }}</p>
                            @endif
                        </div>
                        <svg 
                            :class="{'rotate-180': open}" 
                            class="w-5 h-5 text-purple-400 transform transition-transform duration-200" 
                            fill="none" 
                            viewBox="0 0 24 24" 
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <div x-show="open" class="p-6">
                        <div class="prose prose-invert prose-lg max-w-none">
                            {!! Str::markdown($story->content) !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    
    <!-- Back to Characters Button -->
    <div class="py-12 text-center">
        <a href="{{ route('characters') }}" class="cyber-button inline-block">
            BACK TO CHARACTERS
        </a>
    </div>
</x-layouts.cyberpunk>