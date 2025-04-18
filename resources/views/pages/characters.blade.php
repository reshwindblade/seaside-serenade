<?php

use App\Models\User;
use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;
use Livewire\WithPagination;
 
name('characters');
middleware(['auth', 'verified']);

?>

<x-layouts.magical-ocean>
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
</x-layouts.magical-ocean>