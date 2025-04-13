<!-- resources/views/admin/npcs/edit.blade.php -->
<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Edit NPC') }}: {{ $npc->name }}
            </h2>
            <a href="{{ route('admin.npcs.index') }}" class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to NPCs
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
                    <form action="{{ route('admin.npcs.update', $npc) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $npc->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $npc->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700">
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                            @if($npc->image)
                                <div class="mt-2 mb-4">
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Current image:</p>
                                    <img src="{{ asset('storage/' . $npc->image) }}" alt="{{ $npc->name }}" class="h-32 w-32 object-cover rounded-md border border-gray-200 dark:border-gray-700">
                                </div>
                            @endif
                            <input type="file" name="image" id="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload a new image to replace the current one (optional).</p>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
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
                                rows="15"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                required
                            >{{ old('description', $npc->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                name="is_active"
                                id="is_active"
                                value="1"
                                {{ old('is_active', $npc->is_active) ? 'checked' : '' }}
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
                                value="{{ old('sort_order', $npc->sort_order) }}"
                                min="0"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                            >
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Lower numbers appear first in listings.</p>
                            @error('sort_order')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.npcs.index') }}" class="px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Cancel
                            </a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
            // You could add a preview function here if desired
            const description = document.getElementById('description');
            const previewDiv = document.createElement('div');
            previewDiv.className = 'mt-4 p-4 border border-gray-200 rounded-md bg-gray-50 dark:bg-gray-900 dark:border-gray-700 prose prose-sm max-w-none dark:prose-invert';
            description.parentNode.appendChild(previewDiv);
            
            function updatePreview() {
                previewDiv.innerHTML = marked.parse(description.value);
            }
            
            description.addEventListener('input', updatePreview);
            updatePreview();
        });
    </script>
</x-layouts.app>