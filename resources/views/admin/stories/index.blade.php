<!-- resources/views/admin/stories/create.blade.php -->
<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Create New Short Story') }}
            </h2>
            <a href="{{ route('admin.stories.index') }}" class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Short Stories
                </div>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.stories.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700">
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="character_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Character</label>
                                <select name="character_id" id="character_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700">
                                    <option value="">Select a Character</option>
                                    @foreach($characters as $character)
                                        <option 
                                            value="{{ $character->id }}" 
                                            {{ old('character_id') == $character->id ? 'selected' : '' }}
                                        >
                                            {{ $character->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('character_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="story_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Story Date</label>
                                <input 
                                    type="date" 
                                    name="story_date" 
                                    id="story_date" 
                                    value="{{ old('story_date', date('Y-m-d')) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                >
                                @error('story_date')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="flex items-center">
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $stories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const characterFilter = document.getElementById('character-filter');
            
            characterFilter.addEventListener('change', function() {
                const selectedCharacterId = this.value;
                const currentUrl = new URL(window.location.href);
                
                if (selectedCharacterId) {
                    currentUrl.searchParams.set('character_id', selectedCharacterId);
                } else {
                    currentUrl.searchParams.delete('character_id');
                }
                
                window.location.href = currentUrl.toString();
            });
        });
    </script>
</x-layouts.app>