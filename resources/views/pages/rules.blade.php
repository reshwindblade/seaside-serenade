<?php

use App\Models\Rule;
use function Laravel\Folio\{name};
use Livewire\Volt\Component;

name('rules');

new class extends Component
{
    public $rules = [];
    public $categories = [];
    public $selectedCategory = 'all';

    public function mount()
    {
        $this->loadRules();
    }

    public function loadRules()
    {
        $query = Rule::active()->ordered();
        
        if ($this->selectedCategory !== 'all') {
            $query->byCategory($this->selectedCategory);
        }
        
        $this->rules = $query->get();
        $this->categories = Rule::active()->distinct()->pluck('category')->toArray();
    }

    public function filterByCategory($category)
    {
        $this->selectedCategory = $category;
        $this->loadRules();
    }
};

?>

<x-layouts.magical-ocean>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-10">
            <h1 class="page-title-magical text-center">Rules & How to Play</h1>
            <p class="text-center text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                Learn the game mechanics, character creation rules, and everything you need to start your magical adventure.
            </p>
        </div>

        <!-- Filter tabs -->
        <div class="mb-8 flex flex-wrap justify-center gap-2">
            <button 
                @click="$wire.filterByCategory('all')" 
                class="px-4 py-2 rounded-full text-sm font-medium {{ $selectedCategory === 'all' ? 'bg-pink-500 text-white' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 border border-pink-200 dark:border-purple-800/30' }} 
                       hover:bg-pink-50 dark:hover:bg-pink-900/20 transition-colors"
            >
                All Rules
            </button>
            
            @foreach($categories as $category)
                <button 
                    @click="$wire.filterByCategory('{{ $category }}')" 
                    class="px-4 py-2 rounded-full text-sm font-medium {{ $selectedCategory === $category ? 'bg-pink-500 text-white' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 border border-pink-200 dark:border-purple-800/30' }} 
                           hover:bg-pink-50 dark:hover:bg-pink-900/20 transition-colors"
                >
                    {{ ucfirst($category) }}
                </button>
            @endforeach
        </div>

        <!-- Rules Grid -->
        <div class="pinterest-grid">
            @forelse($rules as $rule)
                <a href="{{ route('rules.show', $rule) }}" class="magical-card flex flex-col h-full transform transition hover:scale-[1.02]">
                    <div class="magical-card-body flex-grow">
                        <h2 class="text-xl font-bold mb-2 text-pink-600 dark:text-pink-300">{{ $rule->name }}</h2>
                        <div class="mb-4">
                            <span class="badge-magical">{{ ucfirst($rule->category) }}</span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 line-clamp-3">
                            {{ Str::limit(strip_tags($rule->description), 100) }}
                        </p>
                    </div>
                    <div class="px-6 py-4 bg-pink-50 dark:bg-pink-900/20 text-right">
                        <span class="text-pink-600 dark:text-pink-300 font-medium inline-flex items-center">
                            Read More
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </span>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-10 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-gray-100">No rules found</h3>
                    <p class="mt-1 text-gray-500 dark:text-gray-400">
                        @if($selectedCategory !== 'all')
                            No rules in the "{{ ucfirst($selectedCategory) }}" category. Try another category or check back later.
                        @else
                            No rules have been added yet. Please check back later.
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
</x-layouts.magical-ocean>