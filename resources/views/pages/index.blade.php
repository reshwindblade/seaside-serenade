<?php

use App\Models\Rule;
use App\Models\Npc;
use App\Models\Character;
use function Laravel\Folio\{name};
use Livewire\Volt\Component;

name('home');

new class extends Component
{
    public function mount()
    {
        // Nothing to do here yet
    }
};

?>

<x-magical-girl.layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-12">
        <!-- Hero section -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-purple-600 dark:from-pink-300 dark:to-purple-300 mb-4">
                Welcome to the Magical Girl Portal
            </h1>
            <p class="text-lg md:text-xl text-gray-700 dark:text-gray-300 max-w-3xl mx-auto">
                Your one-stop destination for all things related to our magical girl role-playing adventure!
            </p>
        </div>
        
        <!-- Featured Sections Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            <a href="{{ route('rules') }}" class="magical-card flex flex-col h-full glow-effect group">
                <div class="magical-card-header relative overflow-hidden h-40">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500 to-yellow-500 opacity-30 dark:opacity-50 group-hover:opacity-40 dark:group-hover:opacity-60 transition-opacity"></div>
                    <div class="relative z-10 h-full flex items-center justify-center">
                        <svg class="h-16 w-16 text-amber-600 dark:text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                </div>
                    <div class="absolute inset-0 bg-gradient-to-br from-pink-500 to-purple-500 opacity-30 dark:opacity-50 group-hover:opacity-40 dark:group-hover:opacity-60 transition-opacity"></div>
                    <div class="relative z-10 h-full flex items-center justify-center">
                        <svg class="h-16 w-16 text-pink-600 dark:text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
                <div class="magical-card-body flex-grow">
                    <h2 class="text-xl font-bold mb-2 text-pink-600 dark:text-pink-300">Rules & How to Play</h2>
                    <p class="text-gray-600 dark:text-gray-300">
                        Learn the game mechanics, character creation rules, and everything you need to start your magical adventure.
                    </p>
                </div>
                <div class="px-6 py-4 bg-pink-50 dark:bg-pink-900/20 text-right">
                    <span class="text-pink-600 dark:text-pink-300 font-medium inline-flex items-center">
                        Explore 
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </span>
                </div>
            </a>
            
            <a href="{{ route('npcs') }}" class="magical-card flex flex-col h-full glow-effect group">
                <div class="magical-card-header relative overflow-hidden h-40">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-indigo-500 opacity-30 dark:opacity-50 group-hover:opacity-40 dark:group-hover:opacity-60 transition-opacity"></div>
                    <div class="relative z-10 h-full flex items-center justify-center">
                        <svg class="h-16 w-16 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="magical-card-body flex-grow">
                    <h2 class="text-xl font-bold mb-2 text-purple-600 dark:text-purple-300">NPCs</h2>
                    <p class="text-gray-600 dark:text-gray-300">
                        Meet the non-player characters who populate our magical world, from mentors and allies to mysterious foes.
                    </p>
                </div>
                <div class="px-6 py-4 bg-purple-50 dark:bg-purple-900/20 text-right">
                    <span class="text-purple-600 dark:text-purple-300 font-medium inline-flex items-center">
                        Discover 
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </span>
                </div>
            </a>
            
            <a href="{{ route('characters') }}" class="magical-card flex flex-col h-full glow-effect group">
                <div class="magical-card-header relative overflow-hidden h-40">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-cyan-500 opacity-30 dark:opacity-50 group-hover:opacity-40 dark:group-hover:opacity-60 transition-opacity"></div>
                    <div class="relative z-10 h-full flex items-center justify-center">
                        <svg class="h-16 w-16 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
                <div class="magical-card-body flex-grow">
                    <h2 class="text-xl font-bold mb-2 text-blue-600 dark:text-blue-300">Player Characters</h2>
                    <p class="text-gray-600 dark:text-gray-300">
                        Learn about our heroes, their unique powers, personalities, and the challenges they face.
                    </p>
                </div>
                <div class="px-6 py-4 bg-blue-50 dark:bg-blue-900/20 text-right">
                    <span class="text-blue-600 dark:text-blue-300 font-medium inline-flex items-center">
                        Meet 
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </span>
                </div>
            </a>
            
            <a href="{{ route('world') }}" class="magical-card flex flex-col h-full glow-effect group">
                <div class="magical-card-header relative overflow-hidden h-40">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500 to-teal-500 opacity-30 dark:opacity-50 group-hover:opacity-40 dark:group-hover:opacity-60 transition-opacity"></div>
                    <div class="relative z-10 h-full flex items-center justify-center">
                        <svg class="h-16 w-16 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="magical-card-body flex-grow">
                    <h2 class="text-xl font-bold mb-2 text-green-600 dark:text-green-300">World Setting</h2>
                    <p class="text-gray-600 dark:text-gray-300">
                        Explore the rich lore and magical world where our adventures take place.
                    </p>
                </div>
                <div class="px-6 py-4 bg-green-50 dark:bg-green-900/20 text-right">
                    <span class="text-green-600 dark:text-green-300 font-medium inline-flex items-center">
                        Coming Soon 
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </span>
                </div>
            </a>
            
            <a href="{{ route('recaps') }}" class="magical-card flex flex-col h-full glow-effect group">
                <div class="magical-card-header relative overflow-hidden h-40">