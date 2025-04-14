<?php

use App\Models\Character;
use function Laravel\Folio\{name};
use Livewire\Volt\Component;

name('characters');

new class extends Component
{
    public $characters = [];
    public $search = '';

    public function mount()
    {
        $this->loadCharacters();
    }

    public function loadCharacters()
    {
        $query = Character::active()->ordered();
        
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('title', 'like', "%{$this->search}%")
                  ->orWhere('player_name', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%");
            });
        }
        
        $this->characters = $query->get();
    }

    public function updatedSearch()
    {
        $this->loadCharacters();
    }
};

?>

<x-magical-girl.layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-10">
            <h1 class="page-title-magical text-center">Player Characters</h1>
            <p class="text-center text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                Meet our heroes, their unique powers, personalities, and the challenges they face.
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
                    class="block w-full pl-10 pr-3 py-2 border border-blue-200 dark:border-blue-700 rounded-full bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-500 focus:border-transparent"
                    placeholder="Search characters..."
                >
            </div>
        </div>

        <!-- Characters Grid -->
        <div class="pinterest-grid">
            @forelse($characters as $character)
                <a href="{{ route('characters.show', $character) }}" class="magical-card flex flex-col h-full transform transition hover:scale-[1.02] overflow-hidden">
                    @if($character->image)
                        <div class="w-full h-64 overflow-hidden">
                            <img src="{{ $character->image }}" alt="{{ $character->name }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                        </div>
                    @endif