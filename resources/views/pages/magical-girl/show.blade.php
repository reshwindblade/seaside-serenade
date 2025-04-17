<x-layouts.magical-ocean>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8 flex justify-between items-center">
                <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 dark:from-blue-400 dark:via-indigo-400 dark:to-purple-400">
                    Your Magical Girl
                </h1>
                
                <a 
                    href="{{ route('magical-girl.edit') }}" 
                    class="inline-flex items-center px-4 py-2 border border-blue-300 dark:border-blue-700 rounded-lg shadow-sm text-sm font-medium text-blue-700 dark:text-blue-300 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-blue-900/20 focus:outline-none transition-colors"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Character
                </a>
            </div>
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-800 rounded-lg text-green-700 dark:text-green-300">
                    {{ session('success') }}
                </div>
            @endif
            
            <!-- Character Card -->
            <div class="relative p-1 bg-gradient-to-r from-{{ strtolower($magicalGirl->signature_color) }}-500 via-indigo-500 to-purple-500 rounded-2xl">
                <div class="bg-white dark:bg-gray-900 rounded-xl overflow-hidden">
                    <!-- Character Header -->
                    <div class="relative h-48 bg-gradient-to-r from-{{ strtolower($magicalGirl->signature_color) }}-600 to-indigo-600 dark:from-{{ strtolower($magicalGirl->signature_color) }}-800 dark:to-indigo-800 flex items-end">
                        <div class="absolute inset-0 opacity-20">
                            <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-black/50 to-transparent"></div>
                        </div>
                        
                        <div class="relative w-full p-6 text-white flex justify-between items-end">
                            <div>
                                <h2 class="text-3xl font-bold">{{ $magicalGirl->magical_name }}</h2>
                                <p class="text-white/80">Civilian Identity: {{ $magicalGirl->character_name }}</p>
                            </div>
                            <div class="flex flex-col items-end">
                                <div class="px-4 py-1 bg-white/20 backdrop-blur-sm rounded-full mb-2">
                                    <span class="text-sm font-medium">{{ $magicalGirl->animation_spirit }} Spirit</span>
                                </div>
                                <div class="flex space-x-2">
                                    <div class="h-6 w-6 rounded-full" style="background-color: {{ $magicalGirl->signature_color }};"></div>
                                    <span class="font-medium">{{ $magicalGirl->signature_color }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <!-- Transformation Phrase -->
                        <div class="mb-8 p-4 bg-{{ strtolower($magicalGirl->signature_color) }}-100 dark:bg-{{ strtolower($magicalGirl->signature_color) }}-900/20 border border-{{ strtolower($magicalGirl->signature_color) }}-200 dark:border-{{ strtolower($magicalGirl->signature_color) }}-800/30 rounded-lg">
                            <h3 class="text-lg font-medium text-{{ strtolower($magicalGirl->signature_color) }}-800 dark:text-{{ strtolower($magicalGirl->signature_color) }}-200 mb-2">
                                Transformation Phrase
                            </h3>
                            <p class="text-{{ strtolower($magicalGirl->signature_color) }}-700 dark:text-{{ strtolower($magicalGirl->signature_color) }}-300 italic">
                                "{{ $magicalGirl->transformation_phrase }}"
                            </p>
                        </div>
                        
                        <!-- Attributes & Derived Stats -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                            <!-- Attributes -->
                            <div>
                                <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-4">
                                    Attributes
                                </h3>
                                
                                <div class="space-y-4">
                                    <!-- Focus -->
                                    <div>
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                                Focus
                                            </span>
                                            <span class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                                {{ $magicalGirl->focus }}
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <div class="bg-blue-600 dark:bg-blue-500 h-2.5 rounded-full" style="width: {{ ($magicalGirl->focus/12)*100 }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Daring -->
                                    <div>
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                                Daring
                                            </span>
                                            <span class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                                {{ $magicalGirl->daring }}
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <div class="bg-pink-600 dark:bg-pink-500 h-2.5 rounded-full" style="width: {{ ($magicalGirl->daring/12)*100 }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Insight -->
                                    <div>
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                                Insight
                                            </span>
                                            <span class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                                {{ $magicalGirl->insight }}
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <div class="bg-purple-600 dark:bg-purple-500 h-2.5 rounded-full" style="width: {{ ($magicalGirl->insight/12)*100 }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Presence -->
                                    <div>
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                                Presence
                                            </span>
                                            <span class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                                {{ $magicalGirl->presence }}
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <div class="bg-cyan-600 dark:bg-cyan-500 h-2.5 rounded-full" style="width: {{ ($magicalGirl->presence/12)*100 }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Might -->
                                    <div>
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                                Might
                                            </span>
                                            <span class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                                {{ $magicalGirl->might }}
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <div class="bg-red-600 dark:bg-red-500 h-2.5 rounded-full" style="width: {{ ($magicalGirl->might/12)*100 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Derived Stats -->
                            <div>
                                <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-4">
                                    Derived Stats
                                </h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Stress -->
                                    <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Stress (Mental Resilience)</div>
                                        <div class="text-2xl font-semibold text-purple-600 dark:text-purple-400">{{ $magicalGirl->stress }}</div>
                                    </div>
                                    
                                    <!-- Harm -->
                                    <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Harm (Physical Endurance)</div>
                                        <div class="text-2xl font-semibold text-red-600 dark:text-red-400">{{ $magicalGirl->harm }}</div>
                                    </div>
                                    
                                    <!-- Physical Defense -->
                                    <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Physical Defense</div>
                                        <div class="text-2xl font-semibold text-amber-600 dark:text-amber-400">{{ $magicalGirl->physical_defense }}</div>
                                    </div>
                                    
                                    <!-- Magical Defense -->
                                    <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Magical Defense</div>
                                        <div class="text-2xl font-semibold text-blue-600 dark:text-blue-400">{{ $magicalGirl->magical_defense }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Skills -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-4">
                                Skills
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Proficient Skills -->
                                <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <h4 class="font-medium text-indigo-600 dark:text-indigo-400 mb-3">Proficient Skills</h4>
                                    <ul class="space-y-2">
                                        @foreach($magicalGirl->proficient_skills as $skillId)
                                            @if(!in_array($skillId, $magicalGirl->mastered_skills))
                                                <li class="flex items-center">
                                                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="text-gray-700 dark:text-gray-300">{{ $skillNames[$skillId] ?? 'Unknown Skill' }}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                
                                <!-- Mastered Skills -->
                                <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <h4 class="font-medium text-purple-600 dark:text-purple-400 mb-3">Mastered Skills</h4>
                                    <ul class="space-y-2">
                                        @foreach($magicalGirl->mastered_skills as $skillId)
                                            <li class="flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $skillNames[$skillId] ?? 'Unknown Skill' }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Character Biography -->
                        @if($magicalGirl->bio)
                        <div>
                            <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-4">
                                Biography
                            </h3>
                            
                            <div class="p-6 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 prose prose-blue dark:prose-invert max-w-none">
                                {{ $magicalGirl->bio }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Decorative Bubbles -->
    <div class="fixed bottom-0 right-0 w-full h-64 pointer-events-none overflow-hidden">
        <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full bg-{{ strtolower($magicalGirl->signature_color) }}-500/5 blur-3xl"></div>
        <div class="absolute bottom-20 right-20 w-6 h-6 rounded-full bg-{{ strtolower($magicalGirl->signature_color) }}-400/30 dark:bg-{{ strtolower($magicalGirl->signature_color) }}-400/20 blur-sm floating" style="animation-delay: 0.3s;"></div>
        <div class="absolute bottom-40 right-40 w-8 h-8 rounded-full bg-indigo-400/30 dark:bg-indigo-400/20 blur-sm floating" style="animation-delay: 0.8s;"></div>
        <div class="absolute bottom-20 right-80 w-5 h-5 rounded-full bg-purple-400/30 dark:bg-purple-400/20 blur-sm floating" style="animation-delay: 1.3s;"></div>
    </div>
</x-layouts.magical-ocean>