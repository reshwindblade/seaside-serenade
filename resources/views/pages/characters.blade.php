<?php

use App\Models\User;
use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;
use Livewire\WithPagination;

name('characters');
middleware(['auth', 'verified']);

new class extends Component
{
    use WithPagination;
    
    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 12;
    public $categories = [];
    public $selectedCategory = '';
    
    public function mount()
    {
        // Sample categories - replace with your actual categories
        $this->categories = [
            'all' => 'All Characters',
            'heroes' => 'Heroes',
            'villains' => 'Villains',
            'sidekicks' => 'Sidekicks',
            'mentors' => 'Mentors'
        ];
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }
    
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    
    public function render()
    {
        // This is a placeholder implementation
        // In a real application, you would fetch characters from your database
        $characters = collect([
            [
                'id' => 1,
                'name' => 'Aragorn',
                'category' => 'heroes', 
                'image' => 'https://ui-avatars.com/api/?name=Aragorn&background=0D8ABC&color=fff',
                'description' => 'The rightful king of Gondor and a skilled ranger.',
                'created_at' => now()->subDays(30)
            ],
            [
                'id' => 2,
                'name' => 'Gandalf',
                'category' => 'mentors',
                'image' => 'https://ui-avatars.com/api/?name=Gandalf&background=4B5563&color=fff',
                'description' => 'A wise wizard who guides the fellowship on their journey.',
                'created_at' => now()->subDays(45)
            ],
            [
                'id' => 3,
                'name' => 'Gollum',
                'category' => 'villains',
                'image' => 'https://ui-avatars.com/api/?name=Gollum&background=DC2626&color=fff',
                'description' => 'A creature corrupted by the One Ring.',
                'created_at' => now()->subDays(60)
            ],
            [
                'id' => 4,
                'name' => 'Legolas',
                'category' => 'heroes',
                'image' => 'https://ui-avatars.com/api/?name=Legolas&background=0D8ABC&color=fff',
                'description' => 'An elf with exceptional archery skills.',
                'created_at' => now()->subDays(20)
            ],
            [
                'id' => 5,
                'name' => 'Samwise',
                'category' => 'sidekicks',
                'image' => 'https://ui-avatars.com/api/?name=Samwise&background=8B5CF6&color=fff',
                'description' => 'Frodo\'s loyal companion throughout the journey.',
                'created_at' => now()->subDays(35)
            ],
            [
                'id' => 6,
                'name' => 'Saruman',
                'category' => 'villains',
                'image' => 'https://ui-avatars.com/api/?name=Saruman&background=DC2626&color=fff',
                'description' => 'A wizard who was corrupted by Sauron.',
                'created_at' => now()->subDays(50)
            ],
            [
                'id' => 7,
                'name' => 'Elrond',
                'category' => 'mentors',
                'image' => 'https://ui-avatars.com/api/?name=Elrond&background=4B5563&color=fff',
                'description' => 'The elf lord of Rivendell and a healer.',
                'created_at' => now()->subDays(40)
            ],
            [
                'id' => 8,
                'name' => 'Galadriel',
                'category' => 'mentors',
                'image' => 'https://ui-avatars.com/api/?name=Galadriel&background=4B5563&color=fff',
                'description' => 'The elf lady of Lothlórien with foresight and wisdom.',
                'created_at' => now()->subDays(55)
            ],
            [
                'id' => 9,
                'name' => 'Gimli',
                'category' => 'heroes',
                'image' => 'https://ui-avatars.com/api/?name=Gimli&background=0D8ABC&color=fff',
                'description' => 'A dwarf warrior and member of the fellowship.',
                'created_at' => now()->subDays(25)
            ],
            [
                'id' => 10,
                'name' => 'Boromir',
                'category' => 'heroes',
                'image' => 'https://ui-avatars.com/api/?name=Boromir&background=0D8ABC&color=fff',
                'description' => 'A warrior from Gondor who briefly joined the fellowship.',
                'created_at' => now()->subDays(30)
            ],
            [
                'id' => 11,
                'name' => 'Sauron',
                'category' => 'villains',
                'image' => 'https://ui-avatars.com/api/?name=Sauron&background=DC2626&color=fff',
                'description' => 'The dark lord who created the One Ring.',
                'created_at' => now()->subDays(70)
            ],
            [
                'id' => 12,
                'name' => 'Merry',
                'category' => 'sidekicks',
                'image' => 'https://ui-avatars.com/api/?name=Merry&background=8B5CF6&color=fff',
                'description' => 'A hobbit who joins the fellowship and helps defeat the Witch-king.',
                'created_at' => now()->subDays(28)
            ]
        ]);
        
        // Filter by search term
        if ($this->search) {
            $characters = $characters->filter(function ($item) {
                return stripos($item['name'], $this->search) !== false || 
                       stripos($item['description'], $this->search) !== false;
            });
        }
        
        // Filter by category
        if ($this->selectedCategory && $this->selectedCategory !== 'all') {
            $characters = $characters->filter(function ($item) {
                return $item['category'] === $this->selectedCategory;
            });
        }
        
        // Sort the collection
        $characters = $characters->sortBy([[$this->sortField, $this->sortDirection]]);
        
        // Paginate the results
        $characters = $this->paginateCollection($characters, $this->perPage);
        
        return view('livewire.characters-list', [
            'characters' => $characters
        ]);
    }
    
    // Helper function to paginate a collection
    private function paginateCollection($collection, $perPage)
    {
        $page = $this->page ?: 1;
        
        $items = $collection->slice(($page - 1) * $perPage, $perPage)->values();
        
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $collection->count(),
            $perPage,
            $page,
            ['path' => \Illuminate\Support\Facades\Request::url()]
        );
        
        return $paginator;
    }
};

?>

<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Characters') }}
            </h2>
        </div>
    </x-slot>

    @volt
    <div>
        <div class="py-6">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                    <!-- Search and Filters -->
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-700 flex flex-col md:flex-row justify-between items-center gap-4">
                        <!-- Search Box -->
                        <div class="relative w-full md:w-64">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input
                                wire:model.live.debounce.300ms="search"
                                type="text"
                                placeholder="Search characters..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-300 transition-all duration-200"
                            />
                        </div>
                        
                        <div class="flex items-center gap-4 w-full md:w-auto">
                            <!-- Category Filter -->
                            <div class="w-full md:w-auto">
                                <select
                                    wire:model.live="selectedCategory"
                                    class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-300 transition-all duration-200 w-full"
                                >
                                    @foreach($categories as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Per Page Selector -->
                            <div class="flex items-center gap-2 w-full md:w-auto">
                                <label for="perPage" class="text-sm text-gray-600 dark:text-gray-400 whitespace-nowrap">Show:</label>
                                <select
                                    wire:model.live="perPage"
                                    id="perPage"
                                    class="border border-gray-300 dark:border-gray-600 rounded-lg px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-300 transition-all duration-200"
                                >
                                    <option value="6">6</option>
                                    <option value="12">12</option>
                                    <option value="24">24</option>
                                    <option value="48">48</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Characters Grid -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse($characters as $character)
                                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-all duration-200">
                                    <div class="aspect-w-16 aspect-h-9 bg-gray-200 dark:bg-gray-700">
                                        <img 
                                            src="{{ $character['image'] }}" 
                                            alt="{{ $character['name'] }}" 
                                            class="object-cover w-full h-48"
                                        >
                                    </div>
                                    <div class="p-5">
                                        <div class="flex justify-between items-start">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ $character['name'] }}</h3>
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                                @if($character['category'] === 'heroes') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 @endif
                                                @if($character['category'] === 'villains') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif
                                                @if($character['category'] === 'sidekicks') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200 @endif
                                                @if($character['category'] === 'mentors') bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @endif
                                            ">
                                                {{ ucfirst($character['category']) }}
                                            </span>
                                        </div>
                                        <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $character['description'] }}</p>
                                        <div class="mt-4 flex justify-between items-center">
                                            <span class="text-sm text-gray-500 dark:text-gray-500">Added {{ $character['created_at']->diffForHumans() }}</span>
                                            <a href="#" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">View details</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full py-12 text-center text-gray-500 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-gray-100">No characters found</h3>
                                    <p class="mt-1 text-gray-500 dark:text-gray-400">Try adjusting your search or filter to find what you're looking for.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700">
                        {{ $characters->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endvolt
</x-layouts.app>