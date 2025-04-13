<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Edit Combat Suit') }}: {{ $suit->name }}
            </h2>
            <a href="{{ route('admin.suits.index') }}" class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Combat Suits
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
                    <form action="{{ route('admin.suits.update', $suit) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $suit->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <div class="flex justify-between items-center">
                                    <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sort Order</label>
                                    <div class="flex items-center">
                                        <input
                                            type="checkbox"
                                            name="is_active"
                                            id="is_active"
                                            value="1"
                                            {{ old('is_active', $suit->is_active) ? 'checked' : '' }}
                                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700"
                                        >
                                        <label for="is_active" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                            Active
                                        </label>
                                    </div>
                                </div>
                                <input
                                    type="number"
                                    name="sort_order"
                                    id="sort_order"
                                    value="{{ old('sort_order', $suit->sort_order) }}"
                                    min="0"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                >
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Lower numbers appear first in listings.</p>
                                @error('sort_order')
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
                                rows="6"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                            >{{ old('description', $suit->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Effects Section -->
                        <div>
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Suit Effects</h3>
                                <button type="button" id="add-effect" class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    Add Effect
                                </button>
                            </div>
                            
                            <div id="effects-container" class="mt-4 space-y-4">
                                <!-- Template effect (hidden) -->
                                <div id="effect-template" class="effect-item hidden border border-gray-300 dark:border-gray-600 rounded-md p-4 bg-gray-50 dark:bg-gray-900">
                                    <div class="flex justify-between items-start mb-4">
                                        <h4 class="text-md font-medium text-gray-700 dark:text-gray-300">Effect <span class="effect-number"></span></h4>
                                        <button type="button" class="remove-effect text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Effect Name</label>
                                            <input 
                                                type="text" 
                                                name="effects[][name]" 
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" 
                                                required
                                            >
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Power Rating</label>
                                            <input 
                                                type="number" 
                                                name="effects[][power_rating]" 
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" 
                                                required
                                            >
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Effect Description</label>
                                        <textarea 
                                            name="effects[][description]" 
                                            rows="3" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                        ></textarea>
                                    </div>
                                    
                                    <input type="hidden" name="effects[][sort_order]" value="0">
                                </div>
                                
                                <!-- Existing effects -->
                                @foreach($suit->effects as $index => $effect)
                                <div class="effect-item border border-gray-300 dark:border-gray-600 rounded-md p-4 bg-gray-50 dark:bg-gray-900">
                                    <div class="flex justify-between items-start mb-4">
                                        <h4 class="text-md font-medium text-gray-700 dark:text-gray-300">Effect <span class="effect-number">{{ $index + 1 }}</span></h4>
                                        <button type="button" class="remove-effect text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Effect Name</label>
                                            <input 
                                                type="text" 
                                                name="effects[{{ $index }}][name]" 
                                                value="{{ old('effects.'.$index.'.name', $effect->name) }}"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" 
                                                required
                                            >
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Power Rating</label>
                                            <input 
                                                type="number" 
                                                name="effects[{{ $index }}][power_rating]" 
                                                value="{{ old('effects.'.$index.'.power_rating', $effect->power_rating) }}"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" 
                                                required
                                            >
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Effect Description</label>
                                        <textarea 
                                            name="effects[{{ $index }}][description]" 
                                            rows="3" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                        >{{ old('effects.'.$index.'.description', $effect->description) }}</textarea>
                                    </div>
                                    
                                    <input type="hidden" name="effects[{{ $index }}][id]" value="{{ $effect->id }}">
                                    <input type="hidden" name="effects[{{ $index }}][sort_order]" value="{{ $effect->sort_order }}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.suits.index') }}" class="px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addEffectButton = document.getElementById('add-effect');
            const effectsContainer = document.getElementById('effects-container');
            const effectTemplate = document.getElementById('effect-template');
            
            // Set up event listener for the add effect button
            addEffectButton.addEventListener('click', function() {
                addNewEffect();
            });
            
            // Set up event delegation for removing effects
            effectsContainer.addEventListener('click', function(event) {
                if (event.target.closest('.remove-effect')) {
                    const effectItem = event.target.closest('.effect-item');
                    if (effectsContainer.querySelectorAll('.effect-item:not(#effect-template)').length > 1) {
                        effectItem.remove();
                        updateEffectNumbers();
                    } else {
                        alert('You must have at least one effect for the combat suit.');
                    }
                }
            });
            
            // Function to add a new effect
            function addNewEffect() {
                const newEffect = effectTemplate.cloneNode(true);
                newEffect.classList.remove('hidden');
                newEffect.removeAttribute('id');
                
                // Update the name attributes for the new effect
                const effectCount = effectsContainer.querySelectorAll('.effect-item:not(#effect-template)').length;
                const inputs = newEffect.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        input.setAttribute('name', name.replace('[]', '[' + effectCount + ']'));
                    }
                });
                
                effectsContainer.appendChild(newEffect);
                updateEffectNumbers();
            }
            
            // Function to update effect numbers
            function updateEffectNumbers() {
                const effectItems = effectsContainer.querySelectorAll('.effect-item:not(#effect-template)');
                effectItems.forEach((item, index) => {
                    const numberElement = item.querySelector('.effect-number');
                    if (numberElement) {
                        numberElement.textContent = index + 1;
                    }
                });
            }
        });
    </script>
</x-layouts.app>