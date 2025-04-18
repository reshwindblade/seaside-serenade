<x-layouts.magical-ocean>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Breadcrumbs -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-300 inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('npcs') }}" class="text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-300 ml-1 md:ml-2">NPCs</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-500 dark:text-gray-400 ml-1 md:ml-2 font-medium">{{ $npc->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <article class="magical-card overflow-hidden">
            <div class="magical-card-header px-6 py-4">
                @if($npc->title)
                    <p class="text-lg text-gray-600 dark:text-gray-400 font-medium">{{ $npc->title }}</p>
                @endif
            </div>
            
            <div class="magical-card-body px-6 py-6">
                <div class="flex flex-col md:flex-row gap-8">
                    @if($npc->image)
                        <div class="md:w-1/3 mb-6 md:mb-0">
                            <img src="{{ $npc->image }}" alt="{{ $npc->name }}" class="rounded-lg shadow-md w-full h-auto">
                        </div>
                    @endif
                    
                    <div class="{{ $npc->image ? 'md:w-2/3' : 'w-full' }}">
                        <h1 class="text-3xl font-bold text-purple-600 dark:text-purple-300 mb-4">{{ $npc->name }}</h1>
                        
                        <div class="prose prose-purple dark:prose-invert max-w-none markdown-content">
                            {!! \Illuminate\Support\Str::markdown($npc->description) !!}
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <!-- Related NPCs -->
        @php
            $relatedNpcs = App\Models\Npc::active()
                ->where('id', '!=', $npc->id)
                ->ordered()
                ->inRandomOrder()
                ->limit(3)
                ->get();
        @endphp
        
        @if($relatedNpcs->count() > 0)
            <div class="mt-10">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Other Characters</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedNpcs as $relatedNpc)
                        <a href="{{ route('npcs.show', $relatedNpc) }}" class="magical-card flex flex-col h-full transform transition hover:scale-[1.02] overflow-hidden">
                            @if($relatedNpc->image)
                                <div class="w-full h-32 overflow-hidden">
                                    <img src="{{ $relatedNpc->image }}" alt="{{ $relatedNpc->name }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                                </div>
                            @endif
                            <div class="magical-card-body flex-grow {{ !$relatedNpc->image ? 'pt-6' : '' }}">
                                <h3 class="text-lg font-bold mb-1 text-purple-600 dark:text-purple-300">{{ $relatedNpc->name }}</h3>
                                @if($relatedNpc->title)
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">{{ $relatedNpc->title }}</p>
                                @endif
                                <p class="text-gray-600 dark:text-gray-300 line-clamp-2">
                                    {{ Str::limit(strip_tags($relatedNpc->description), 80) }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mt-10 text-center">
            <a href="{{ route('npcs') }}" class="btn-magical-secondary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to NPCs
            </a>
        </div>
    </div>
</x-layouts.magical-ocean>