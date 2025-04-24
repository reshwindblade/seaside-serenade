<x-layouts.magical-ocean>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 dark:from-blue-400 dark:via-indigo-400 dark:to-purple-400">
                    Your Magical Girls
                </h1>
                
                <a 
                    href="{{ route('magical-girl.create') }}" 
                    class="relative overflow-hidden group inline-flex items-center px-6 py-3 font-medium text-sm rounded-xl text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-blue-700/30 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900"
                >
                    <span class="relative z-10">Create New Magical Girl</span>
                    <span class="absolute inset-0 overflow-hidden rounded-xl">
                        <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-60"></span>
                    </span>
                </a>
            </div>
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-800 rounded-lg text-green-700 dark:text-green-300">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('info'))
                <div class="mb-6 p-4 bg-blue-100 dark:bg-blue-900/30 border border-blue-300 dark:border-blue-800 rounded-lg text-blue-700 dark:text-blue-300">
                    {{ session('info') }}
                </div>
            @endif
            
            @if($magicalGirls->isEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-blue-100 dark:border-blue-800/30 shadow-md p-8 text-center">
                    <svg class="mx-auto h-16 w-16 text-blue-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">No Magical Girls Yet</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">You haven't created any magical girls yet. Start your adventure by creating your first character!</p>
                    <a 
                        href="{{ route('magical-girl.create') }}" 
                        class="relative overflow-hidden group inline-flex items-center px-6 py-3 font-medium text-sm rounded-xl text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-blue-700/30 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900"
                    >
                        <span class="relative z-10">Create Your First Magical Girl</span>
                        <span class="absolute inset-0 overflow-hidden rounded-xl">
                            <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-60"></span>
                        </span>
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($magicalGirls as $character)
                        <div class="magical-card overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                            <div class="h-2 bg-gradient-to-r from-{{ strtolower($character->signature_color) }}-500 via-indigo-500 to-purple-500"></div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-blue-900 dark:text-blue-100">{{ $character->magical_name }}</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $character->character_name }}</p>
                                    </div>
                                    <span class="px-3 py-1 text-xs rounded-full bg-{{ strtolower($character->signature_color) }}-100 dark:bg-{{ strtolower($character->signature_color) }}-900/20 text-{{ strtolower($character->signature_color) }}-800 dark:text-{{ strtolower($character->signature_color) }}-300">
                                        {{ ucfirst($character->animation_spirit) }} Spirit
                                    </span>
                                </div>
                                
                                <div class="grid grid-cols-3 gap-2 mb-4">
                                    <div class="text-center p-2 bg-blue-50 dark:bg-blue-900/20 rounded">
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Focus</div>
                                        <div class="font-bold text-blue-600 dark:text-blue-400">{{ $character->focus }}</div>
                                    </div>
                                    <div class="text-center p-2 bg-pink-50 dark:bg-pink-900/20 rounded">
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Daring</div>
                                        <div class="font-bold text-pink-600 dark:text-pink-400">{{ $character->daring }}</div>
                                    </div>
                                    <div class="text-center p-2 bg-purple-50 dark:bg-purple-900/20 rounded">
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Insight</div>
                                        <div class="font-bold text-purple-600 dark:text-purple-400">{{ $character->insight }}</div>
                                    </div>
                                </div>
                                
                                <div class="flex flex-wrap gap-1 mb-4">
                                    <div class="px-2 py-1 text-xs bg-indigo-100 dark:bg-indigo-900/20 text-indigo-800 dark:text-indigo-300 rounded-full">
                                        {{ $character->stress }} Stress
                                    </div>
                                    <div class="px-2 py-1 text-xs bg-red-100 dark:bg-red-900/20 text-red-800 dark:text-red-300 rounded-full">
                                        {{ $character->harm }} Harm
                                    </div>
                                    <div class="px-2 py-1 text-xs bg-amber-100 dark:bg-amber-900/20 text-amber-800 dark:text-amber-300 rounded-full">
                                        {{ $character->physical_defense }} Phys Def
                                    </div>
                                    <div class="px-2 py-1 text-xs bg-blue-100 dark:bg-blue-900/20 text-blue-800 dark:text-blue-300 rounded-full">
                                        {{ $character->magical_defense }} Magic Def
                                    </div>
                                </div>
                                
                                <div class="flex justify-between mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <div class="flex space-x-2">
                                        <a 
                                            href="{{ route('magical-girl.show', $character->id) }}" 
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-800/30 transition-colors"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            View
                                        </a>
                                        <a 
                                            href="{{ route('magical-girl.edit', $character->id) }}" 
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-300 hover:bg-indigo-100 dark:hover:bg-indigo-800/30 transition-colors"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                    </div>
                                    
                                    <form 
                                        action="{{ route('magical-girl.destroy', $character->id) }}" 
                                        method="POST" 
                                        onsubmit="return confirm('Are you sure you want to delete this magical girl?');"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-800/30 transition-colors"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts.magical-ocean>