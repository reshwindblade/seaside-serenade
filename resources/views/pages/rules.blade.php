<x-layouts.magical-ocean>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-10">
            <h1 class="page-title-magical text-center">Rules & How to Play</h1>
            <p class="text-center text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                Learn the game mechanics, character creation rules, and everything you need to start your magical adventure.
            </p>
        </div>

        @livewire('rules-list')

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