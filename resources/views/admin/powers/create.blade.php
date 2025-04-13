<!-- resources/views/admin/powers/create.blade.php -->
<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Create New Power') }}
            </h2>
            <a href="{{ route('admin.powers.index') }}" class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Powers
                </div>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.powers.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input list="categories" name="category" id="category" value="{{ old('category') }}" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700">
                                    <datalist id="categories">
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat }}">
                                        @endforeach
                                    </datalist>
                                </div>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Enter existing category or create a new one</p>
                                @error('category')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description (Markdown)</label>
                            <div class="flex justify-between items-center mb-1">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Use Markdown for formatting.</p>
                                <a href="https://www.markdownguide.org/cheat-sheet/" target="_blank" class="text-xs text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">Markdown Cheatsheet</a>
                            </div>
                            <textarea
                                name="description"
                                id="description"
                                rows="10"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                required
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="requirements" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Requirements (Markdown)</label>
                            <textarea
                                name="requirements"
                                id="requirements"
                                rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                            >{{ old('requirements') }}</textarea>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Prerequisites needed to use this power (optional)</p>
                            @error('requirements')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="mechanics" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Game Mechanics (Markdown)</label>
                            <textarea
                                name="mechanics"
                                id="mechanics"
                                rows="6"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                            >{{ old('mechanics') }}</textarea>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Game mechanics and rules for using this power (optional)</p>
                            @error('mechanics')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                name="is_active"
                                id="is_active"
                                value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700"
                            >
                            <label for="is_active" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                Active
                            </label>
                        </div>
                        
                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sort Order</label>
                            <input
                                type="number"
                                name="sort_order"
                                id="sort_order"
                                value="{{ old('sort_order', 0) }}"
                                min="0"
                                class="mt-1 block w-28 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                            >
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Lower numbers appear first in listings.</p>
                            @error('sort_order')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Preview</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="text-md font-medium text-gray-700 dark:text-gray-300 mb-2">Description</h4>
                                    <div class="p-4 border border-gray-300 rounded-md bg-gray-50 dark:bg-gray-900 dark:border-gray-700 prose prose-sm max-w-none dark:prose-invert" id="preview-requirements">
                                        <!-- Requirements and mechanics preview will be inserted here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Create Power
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
            const descriptionTextarea = document.getElementById('description');
            const requirementsTextarea = document.getElementById('requirements');
            const mechanicsTextarea = document.getElementById('mechanics');
            
            const descriptionPreview = document.getElementById('preview-description');
            const requirementsPreview = document.getElementById('preview-requirements');
            
            // Function to update description preview
            function updateDescriptionPreview() {
                descriptionPreview.innerHTML = marked.parse(descriptionTextarea.value);
            }
            
            // Function to update requirements and mechanics preview
            function updateRequirementsPreview() {
                let content = '';
                
                if (requirementsTextarea.value) {
                    content += '<h5 class="text-md font-semibold mb-2">Requirements</h5>';
                    content += marked.parse(requirementsTextarea.value);
                }
                
                if (mechanicsTextarea.value) {
                    content += '<h5 class="text-md font-semibold mt-4 mb-2">Game Mechanics</h5>';
                    content += marked.parse(mechanicsTextarea.value);
                }
                
                requirementsPreview.innerHTML = content;
            }
            
            // Initial previews
            updateDescriptionPreview();
            updateRequirementsPreview();
            
            // Update previews on input
            descriptionTextarea.addEventListener('input', updateDescriptionPreview);
            requirementsTextarea.addEventListener('input', updateRequirementsPreview);
            mechanicsTextarea.addEventListener('input', updateRequirementsPreview);
        });
    </script>
</x-layouts.app>