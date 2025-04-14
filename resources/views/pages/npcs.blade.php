<?php

use App\Models\Npc;
use function Laravel\Folio\{name};
use Livewire\Volt\Component;

name('npcs');

new class extends Component
{
    public $npcs = [];
    public $search = '';

    public function mount()
    {
        $this->loadNpcs();
    }

    public function loadNpcs()
    {
        $query = Npc::active()->ordered();
        
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('title', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%");
            });
        }
        
        $this->npcs = $query->get();
    }

    public function updatedSearch()
    {
        $this->loadNpcs();
    }
};

?>

<x-magical-girl.layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-10">
            <h1 class="page-title-magical text-center">Non-Player Characters</h1>
            <p class="text-center text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                Meet the non-player characters who populate our magical world, from mentors and allies to mysterious foes.
            </p>
        </div>

        <!-- Search bar -->
        <div class="mb-8 max-w-md mx-auto">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input 
                    wire:model.live.debounce.300ms="search" 
                    type="text" 
                    class="block w-full pl-10 pr-3 py-2 border border-pink-200 dark:border-purple-700 rounded-full bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-pink-500 dark:focus:ring-purple-500 focus:border-transparent"
                    placeholder="Search NPCs..."
                >
            </div>
        </div>

        <!-- NPCs Grid -->
        <div class="pinterest-grid">
            @forelse($npcs as $npc)
                <a href="{{ route('npcs.show', $npc) }}" class="magical-card flex flex-col h-full transform transition hover:scale-[1.02] overflow-hidden">
                    @if($npc->image)
                        <div class="w-full h-48 overflow-hidden">
                            <img src="{{ $npc->image }}" alt="{{ $npc->name }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                        </div>
                    @endif
                    <div class="magical-card-body flex-grow {{ !$npc->image ? 'pt-6' : '' }}">
                        <h2 class="text-xl font-bold mb-1 text-purple-600 dark:text-purple-300">{{ $npc->name }}</h2>
                        @if($npc->title)
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-3">{{ $npc->title }}</p>
                        @endif
                        <p class="text-gray-600 dark:text-gray-300 line-clamp-3">
                            {{ Str::limit(strip_tags($npc->description), 100) }}
                        </p>
                    </div>
                    <div class="px-6 py-4 bg-purple-50 dark:bg-purple-900/20 text-right">
                        <span class="text-purple-600 dark:text-purple-300 font-medium inline-flex items-center">
                            Learn More
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </span>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-10 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-gray-100">No NPCs found</h3>
                    <p class="mt-1 text-gray-500 dark:text-gray-400">
                        @if(!empty($search))
                            No NPCs match your search "{{ $search }}". Try different keywords.
                        @else
                            No NPCs have been added yet. Please check back later.
                        @endif
                    </p>
                </div>
            @endforelse
        </div>

        <!-- Back to top button -->
        <button id="back-to-top" class="back-to-top" style="display: none;">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>
    </div>

    <script>
        // Back to top functionality
        document.addEventListener('DOMContentLoaded', function() {
            const backToTopButton = document.getElementById('back-to-top');
            
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopButton.style.display = 'flex';
                } else {
                    backToTopButton.style.display = 'none';
                }
            });
            
            backToTopButton.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>
</x-magical-girl.layout>