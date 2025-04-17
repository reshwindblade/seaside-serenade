<x-layouts.magical-ocean>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="pb-8 text-center">
                <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 dark:from-blue-400 dark:via-indigo-400 dark:to-purple-400">
                    Edit Your Magical Girl
                </h1>
                <p class="mt-3 text-blue-800/70 dark:text-blue-200/70">
                    Update your magical alter ego's basic information
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
            
            <form method="POST" action="{{ route('magical-girl.update') }}">
                @csrf
                @method('PUT')
                
                <div class="relative p-1 bg-gradient-to-r from-{{ strtolower($magicalGirl->signature_color) }}-500 via-indigo-500 to-purple-500 rounded-2xl">
                    <div class="bg-white dark:bg-gray-900 rounded-xl p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Character Name -->
                            <div>
                                <label for="character_name" class="block text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">
                                    Character Name
                                </label>
                                <input 
                                    type="text" 
                                    name="character_name" 
                                    id="character_name" 
                                    value="{{ old('character_name', $magicalGirl->character_name) }}" 
                                    class="block w-full px-4 py-3 border border-blue-200 dark:border-blue-800 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 bg-blue-50/50 dark:bg-blue-900/20 text-blue-900 dark:text-blue-100"
                                    placeholder="Your character's civilian name"
                                >
                            </div>
                            
                            <!-- Magical Name -->
                            <div>
                                <label for="magical_name" class="block text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">
                                    Magical Name
                                </label>
                                <input 
                                    type="text" 
                                    name="magical_name" 
                                    id="magical_name" 
                                    value="{{ old('magical_name', $magicalGirl->magical_name) }}" 
                                    class="block w-full px-4 py-3 border border-blue-200 dark:border-blue-800 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 bg-blue-50/50 dark:bg-blue-900/20 text-blue-900 dark:text-blue-100"
                                    placeholder="Your magical alter ego name"
                                >
                            </div>
                            
                            <!-- Signature Color -->
                            <div>
                                <label for="signature_color" class="block text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">
                                    Signature Color
                                </label>
                                <div class="relative">
                                    <input 
                                        type="text" 
                                        name="signature_color" 
                                        id="signature_color" 
                                        value="{{ old('signature_color', $magicalGirl->signature_color) }}" 
                                        class="block w-full px-4 py-3 border border-blue-200 dark:border-blue-800 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 bg-blue-50/50 dark:bg-blue-900/20 text-blue-900 dark:text-blue-100"
                                        placeholder="E.g., Pink, Blue, Violet"
                                    >
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <input 
                                            type="color" 
                                            id="color_picker" 
                                            class="h-8 w-8 rounded-full cursor-pointer border-0 bg-transparent"
                                            oninput="document.getElementById('signature_color').value = this.value"
                                            value="{{ old('signature_color', $magicalGirl->signature_color) }}"
                                        >
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Animation Spirit -->
                            <div>
                                <label for="animation_spirit" class="block text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">
                                    Animation Spirit
                                </label>
                                <input 
                                    type="text" 
                                    name="animation_spirit" 
                                    id="animation_spirit" 
                                    value="{{ old('animation_spirit', $magicalGirl->animation_spirit) }}" 
                                    class="block w-full px-4 py-3 border border-blue-200 dark:border-blue-800 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 bg-blue-50/50 dark:bg-blue-900/20 text-blue-900 dark:text-blue-100"
                                    placeholder="E.g., Cat, Dolphin, Dragonfly"
                                >
                            </div>
                            
                            <!-- Transformation Phrase -->
                            <div class="md:col-span-2">
                                <label for="transformation_phrase" class="block text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">
                                    Transformation Phrase
                                </label>
                                <textarea 
                                    name="transformation_phrase" 
                                    id="transformation_phrase" 
                                    rows="3" 
                                    class="block w-full px-4 py-3 border border-blue-200 dark:border-blue-800 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 bg-blue-50/50 dark:bg-blue-900/20 text-blue-900 dark:text-blue-100"
                                    placeholder="What you say when transforming"
                                >{{ old('transformation_phrase', $magicalGirl->transformation_phrase) }}</textarea>
                            </div>
                            
                            <!-- Character Biography -->
                            <div class="md:col-span-2">
                                <label for="bio" class="block text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">
                                    Character Biography
                                </label>
                                <textarea 
                                    name="bio" 
                                    id="bio" 
                                    rows="6" 
                                    class="block w-full px-4 py-3 border border-blue-200 dark:border-blue-800 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 bg-blue-50/50 dark:bg-blue-900/20 text-blue-900 dark:text-blue-100"
                                    placeholder="Write your character's story..."
                                >{{ old('bio', $magicalGirl->bio) }}</textarea>
                            </div>
                        </div>
                        
                        <div class="mt-8 pt-6 border-t border-blue-200 dark:border-blue-800">
                            <div class="flex justify-between">
                                <a 
                                    href="{{ route('magical-girl.show') }}" 
                                    class="inline-flex items-center px-4 py-2 border border-blue-300 dark:border-blue-700 rounded-lg shadow-sm text-sm font-medium text-blue-700 dark:text-blue-300 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-blue-900/20 focus:outline-none transition-colors"
                                >
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Cancel
                                </a>
                                
                                <button 
                                    type="submit"
                                    class="relative overflow-hidden group inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-blue-700/30 focus:outline-none transition-all duration-300 hover:scale-105"
                                >
                                    <span class="relative z-10">Update Character</span>
                                    <span class="absolute inset-0 overflow-hidden rounded-lg">
                                        <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-80"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
            <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
                <p>Note: To modify your attributes and skills, please contact a Game Master.</p>
            </div>
        </div>
    </div>
</x-layouts.magical-ocean>