<x-layouts.magical-ocean>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="pb-8 text-center">
                <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 dark:from-blue-400 dark:via-indigo-400 dark:to-purple-400">
                    Create Your Magical Girl
                </h1>
                <p class="mt-3 text-blue-800/70 dark:text-blue-200/70">
                    Design your magical alter ego by selecting abilities, attributes, and powers
                </p>
            </div>
            
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/30 border border-red-300 dark:border-red-800 rounded-lg">
                    <div class="font-medium text-red-700 dark:text-red-300">
                        Oops! There were some issues with your character:
                    </div>
                    <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if(session('info'))
                <div class="mb-6 p-4 bg-blue-100 dark:bg-blue-900/30 border border-blue-300 dark:border-blue-800 rounded-lg text-blue-700 dark:text-blue-300">
                    {{ session('info') }}
                </div>
            @endif
            
            <x-magical-girl.creation-form :skillsByAttribute="$skillsByAttribute" />
            
            <!-- Decorative elements -->
            <div class="relative mt-8">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-blue-200 dark:border-blue-800/50"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-gradient-to-r from-blue-50 via-white to-blue-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 px-3 text-sm text-blue-500 dark:text-blue-400">
                        Magical Ocean Portal
                    </span>
                </div>
            </div>
            
            <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
                <p>Need help creating your character? Check out the <a href="{{ route('rules') }}" class="text-blue-600 dark:text-blue-400 hover:underline">game rules</a> or explore <a href="{{ route('characters') }}" class="text-blue-600 dark:text-blue-400 hover:underline">other characters</a> for inspiration.</p>
            </div>
        </div>
    </div>
    
    <!-- Floating bubbles decoration -->
    <div class="fixed bottom-0 right-0 w-full h-64 pointer-events-none overflow-hidden">
        <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full bg-blue-500/5 blur-3xl"></div>
        <div class="absolute bottom-20 right-20 w-6 h-6 rounded-full bg-blue-400/30 dark:bg-blue-400/20 blur-sm floating" style="animation-delay: 0.3s;"></div>
        <div class="absolute bottom-40 right-40 w-8 h-8 rounded-full bg-indigo-400/30 dark:bg-indigo-400/20 blur-sm floating" style="animation-delay: 0.8s;"></div>
        <div class="absolute bottom-20 right-80 w-5 h-5 rounded-full bg-purple-400/30 dark:bg-purple-400/20 blur-sm floating" style="animation-delay: 1.3s;"></div>
    </div>
</x-layouts.magical-ocean>