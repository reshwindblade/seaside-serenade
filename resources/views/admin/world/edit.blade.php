<!-- resources/views/admin/world/edit.blade.php -->
<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Edit World Setting') }}
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Dashboard
                </div>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md dark:bg-green-900/50 dark:border-green-700 dark:text-green-300">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.world.update') }}" method="POST">
                        @csrf
                        
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-2">
                                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">World Setting Content (Markdown)</label>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    <a href="https://www.markdownguide.org/cheat-sheet/" target="_blank" class="underline">Markdown Cheatsheet</a>
                                </div>
                            </div>
                            
                            <textarea
                                id="content"
                                name="content"
                                rows="20"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                required
                            >{{ old('content', $world->content) }}</textarea>
                            
                            @error('content')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Preview</h3>
                            <div class="p-4 border border-gray-300 rounded-md bg-gray-50 dark:bg-gray-900 dark:border-gray-700 prose prose-sm max-w-none dark:prose-invert" id="preview">
                                <!-- Preview will be inserted here -->
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contentTextarea = document.getElementById('content');
            const previewDiv = document.getElementById('preview');
            
            // Function to update preview
            function updatePreview() {
                previewDiv.innerHTML = marked.parse(contentTextarea.value);
            }
            
            // Initial preview
            updatePreview();
            
            // Update preview on input
            contentTextarea.addEventListener('input', updatePreview);
        });
    </script>
</x-layouts.app>