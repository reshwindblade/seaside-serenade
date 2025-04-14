<?php

use function Laravel\Folio\{name};
use Livewire\Volt\Component;

name('powers');

new class extends Component
{
    // Nothing needed here for coming soon page
};

?>

<x-magical-girl.layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="flex flex-col items-center justify-center">
            <div class="coming-soon-banner">
                <svg class="h-24 w-24 mx-auto mb-6 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                
                <h1 class="coming-soon-text mb-4">Powers & Abilities - Coming Soon!</h1>
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto">
                    We're currently documenting all the magical powers, transformations, and special abilities in our world. 
                    Check back soon to discover the amazing magical capabilities of our characters!
                </p>
                
                <div class="animate-pulse flex space-x-4 justify-center">
                    <div class="h-3 w-3 bg-red-400 dark:bg-red-600 rounded-full"></div>
                    <div class="h-3 w-3 bg-orange-400 dark:bg-orange-600 rounded-full"></div>
                    <div class="h-3 w-3 bg-pink-400 dark:bg-pink-600 rounded-full"></div>
                </div>
            </div>
            
            <div class="mt-10">
                <a href="{{ route('home') }}" class="btn-magical-secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</x-magical-girl.layout>