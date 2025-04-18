<x-layouts.magical-ocean>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="flex flex-col items-center justify-center">
            <div class="coming-soon-banner">
                <svg class="h-24 w-24 mx-auto mb-6 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                
                <h1 class="coming-soon-text mb-4">Adventure Recaps - Coming Soon!</h1>
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto">
                    Our magical adventures are being documented. Check back soon to read recaps of previous adventures and get caught up on the story so far!
                </p>
                
                <div class="animate-pulse flex space-x-4 justify-center">
                    <div class="h-3 w-3 bg-blue-400 dark:bg-blue-600 rounded-full"></div>
                    <div class="h-3 w-3 bg-indigo-400 dark:bg-indigo-600 rounded-full"></div>
                    <div class="h-3 w-3 bg-violet-400 dark:bg-violet-600 rounded-full"></div>
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