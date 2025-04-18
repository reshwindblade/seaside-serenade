<x-layouts.magical-ocean>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="flex flex-col items-center justify-center">
            <div class="coming-soon-banner">
                <svg class="h-24 w-24 mx-auto mb-6 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                
                <h1 class="coming-soon-text mb-4">World Setting - Coming Soon!</h1>
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto">
                    We're currently working on creating detailed information about our magical world. 
                    Check back soon to discover the rich lore, locations, and history of our setting!
                </p>
                
                <div class="animate-pulse flex space-x-4 justify-center">
                    <div class="h-3 w-3 bg-pink-400 dark:bg-pink-600 rounded-full"></div>
                    <div class="h-3 w-3 bg-purple-400 dark:bg-purple-600 rounded-full"></div>
                    <div class="h-3 w-3 bg-blue-400 dark:bg-blue-600 rounded-full"></div>
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
</x-layouts.magical-ocean>