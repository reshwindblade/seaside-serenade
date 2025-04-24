<!-- resources/views/components/magical-girl/creation-form.blade.php -->
<div class="magical-girl-creation-form">
    <form method="POST" action="{{ route('magical-girl.store') }}" class="space-y-8">
        @csrf
        
        <!-- Step Navigation -->
        <div x-data="{ currentStep: 1, totalSteps: 4 }" class="mb-10">
            <div class="relative">
                <div class="absolute left-0 top-1/2 w-full h-1 bg-gray-200 dark:bg-gray-700 transform -translate-y-1/2"></div>
                <div class="flex justify-between relative">
                    <!-- Basic Info Step -->
                    <div class="step-indicator" :class="{ 'active': currentStep >= 1, 'completed': currentStep > 1 }">
                        <div @click="currentStep = 1" class="relative z-10 flex items-center justify-center w-10 h-10 rounded-full cursor-pointer transition-all duration-300"
                            :class="currentStep >= 1 ? 'bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 text-white' : 'bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-600'">
                            <span x-show="currentStep <= 1">1</span>
                            <svg x-show="currentStep > 1" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="absolute top-12 left-1/2 transform -translate-x-1/2 text-xs font-medium" 
                            :class="currentStep >= 1 ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400'">
                            Basic Info
                        </span>
                    </div>
                    
                    <!-- Attributes Step -->
                    <div class="step-indicator" :class="{ 'active': currentStep >= 2, 'completed': currentStep > 2 }">
                        <div @click="currentStep >= 2 ? currentStep = 2 : null" class="relative z-10 flex items-center justify-center w-10 h-10 rounded-full cursor-pointer transition-all duration-300"
                            :class="currentStep >= 2 ? 'bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 text-white' : 'bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-600'">
                            <span x-show="currentStep <= 2">2</span>
                            <svg x-show="currentStep > 2" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="absolute top-12 left-1/2 transform -translate-x-1/2 text-xs font-medium" 
                            :class="currentStep >= 2 ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400'">
                            Attributes
                        </span>
                    </div>
                    
                    <!-- Skills Step -->
                    <div class="step-indicator" :class="{ 'active': currentStep >= 3, 'completed': currentStep > 3 }">
                        <div @click="currentStep >= 3 ? currentStep = 3 : null" class="relative z-10 flex items-center justify-center w-10 h-10 rounded-full cursor-pointer transition-all duration-300"
                            :class="currentStep >= 3 ? 'bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 text-white' : 'bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-600'">
                            <span x-show="currentStep <= 3">3</span>
                            <svg x-show="currentStep > 3" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="absolute top-12 left-1/2 transform -translate-x-1/2 text-xs font-medium" 
                            :class="currentStep >= 3 ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400'">
                            Skills
                        </span>
                    </div>
                    
                    <!-- Review Step -->
                    <div class="step-indicator" :class="{ 'active': currentStep >= 4, 'completed': currentStep > 4 }">
                        <div @click="currentStep >= 4 ? currentStep = 4 : null" class="relative z-10 flex items-center justify-center w-10 h-10 rounded-full cursor-pointer transition-all duration-300"
                            :class="currentStep >= 4 ? 'bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 text-white' : 'bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-600'">
                            <span>4</span>
                        </div>
                        <span class="absolute top-12 left-1/2 transform -translate-x-1/2 text-xs font-medium" 
                            :class="currentStep >= 4 ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400'">
                            Review
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div x-data="{ 
            currentStep: 1,
            characterName: '',
            magicalName: '',
            signatureColor: '#1a91ff',
            animationSpirit: '',
            transformationPhrase: '',
            bio: '',
            
            // Attributes - starting values
            focus: 6,
            daring: 6,
            insight: 6,
            presence: 6,
            might: 6,
            totalPoints: 30,
            maxPoints: 45,
            minAttribute: 6,
            maxAttribute: 12,
            
            // Skills
            proficientSkills: [],
            masteredSkills: [],
            
            // Derived stats - calculated based on attributes
            stress: 3,
            harm: 3,
            physicalDefense: 6,
            magicalDefense: 6,
            
            // Methods for calculating derived stats
            calculateDerivedStats() {
                this.stress = Math.max(Math.floor(this.insight / 2), Math.floor(this.focus / 2));
                this.harm = Math.max(Math.floor(this.might / 2), Math.floor(this.daring / 2));
                this.physicalDefense = Math.floor((this.daring + this.might) / 2);
                this.magicalDefense = Math.floor((this.focus + this.insight + this.presence) / 3);
            },
            
            // Methods for attribute management
            incrementAttribute(attr) {
                if (this[attr] < this.maxAttribute && this.totalPoints < this.maxPoints) {
                    this[attr]++;
                    this.totalPoints++;
                    this.calculateDerivedStats();
                }
            },
            decrementAttribute(attr) {
                if (this[attr] > this.minAttribute) {
                    this[attr]--;
                    this.totalPoints--;
                    this.calculateDerivedStats();
                }
            },
            
            // Skill management
            toggleProficientSkill(skillId) {
                const index = this.proficientSkills.indexOf(skillId);
                if (index === -1) {
                    // Only allow 5 proficient skills
                    if (this.proficientSkills.length < 5) {
                        this.proficientSkills.push(skillId);
                    }
                } else {
                    // If removing a skill that's also mastered, remove from mastered too
                    const masteredIndex = this.masteredSkills.indexOf(skillId);
                    if (masteredIndex !== -1) {
                        this.masteredSkills.splice(masteredIndex, 1);
                    }
                    this.proficientSkills.splice(index, 1);
                }
            },
            toggleMasteredSkill(skillId) {
                // Can only master skills that are already proficient
                if (!this.proficientSkills.includes(skillId)) return;
                
                const index = this.masteredSkills.indexOf(skillId);
                if (index === -1) {
                    // Only allow 2 mastered skills
                    if (this.masteredSkills.length < 2) {
                        this.masteredSkills.push(skillId);
                    }
                } else {
                    this.masteredSkills.splice(index, 1);
                }
            },
            
            // Form validation
            validateStep1() {
                return this.characterName && this.magicalName && this.signatureColor && this.animationSpirit && this.transformationPhrase;
            },
            validateStep2() {
                return this.totalPoints === this.maxPoints;
            },
            validateStep3() {
                return this.proficientSkills.length === 5 && this.masteredSkills.length === 2;
            },
            
            // Navigation
            nextStep() {
                if (this.currentStep === 1 && this.validateStep1()) {
                    this.currentStep = 2;
                } else if (this.currentStep === 2 && this.validateStep2()) {
                    this.currentStep = 3;
                } else if (this.currentStep === 3 && this.validateStep3()) {
                    this.currentStep = 4;
                }
            },
            prevStep() {
                if (this.currentStep > 1) {
                    this.currentStep--;
                }
            }
        }" class="relative">
            <!-- Step 1: Basic Information -->
            <div x-show="currentStep === 1" class="transition-all duration-300">
                <h3 class="text-xl font-semibold text-blue-900 dark:text-blue-100 mb-6">Step 1: Basic Information</h3>
                
                <div class="space-y-6">
                    <!-- Character Name -->
                    <div>
                        <label for="character_name" class="block text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">
                            Character Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="character_name" 
                            id="character_name" 
                            x-model="characterName"
                            class="block w-full px-4 py-3 border border-blue-200 dark:border-blue-800 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 bg-blue-50/50 dark:bg-blue-900/20 text-blue-900 dark:text-blue-100"
                            placeholder="Your character's civilian name"
                        >
                        @error('character_name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Magical Name -->
                    <div>
                        <label for="magical_name" class="block text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">
                            Magical Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="magical_name" 
                            id="magical_name" 
                            x-model="magicalName"
                            class="block w-full px-4 py-3 border border-blue-200 dark:border-blue-800 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 bg-blue-50/50 dark:bg-blue-900/20 text-blue-900 dark:text-blue-100"
                            placeholder="Your magical alter ego name"
                        >
                        @error('magical_name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Signature Color -->
                    <div>
                        <label for="signature_color" class="block text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">
                            Signature Color <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                name="signature_color" 
                                id="signature_color" 
                                x-model="signatureColor" 
                                class="block w-full pl-4 pr-12 py-3 border border-blue-200 dark:border-blue-800 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 bg-blue-50/50 dark:bg-blue-900/20 text-blue-900 dark:text-blue-100"
                                placeholder="E.g., Pink, Blue, Violet"
                            >
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <input 
                                    type="color" 
                                    x-model="signatureColor"
                                    class="h-8 w-8 rounded-full cursor-pointer border-0 bg-transparent"
                                >
                            </div>
                        </div>
                        @error('signature_color')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Animation Spirit -->
                    <div>
                        <label for="animation_spirit" class="block text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">
                            Animation Spirit <span class="text-red-500">*</span>
                        </label>
                        <select
                            name="animation_spirit"
                            id="animation_spirit"
                            x-model="animationSpirit"
                            class="block w-full px-4 py-3 border border-blue-200 dark:border-blue-800 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 bg-blue-50/50 dark:bg-blue-900/20 text-blue-900 dark:text-blue-100"
                        >
                            <option value="">Select an Animation Spirit</option>
                            <option value="cat">Cat</option>
                            <option value="dolphin">Dolphin</option>
                            <option value="butterfly">Butterfly</option>
                            <option value="fox">Fox</option>
                            <option value="owl">Owl</option>
                            <option value="rabbit">Rabbit</option>
                            <option value="wolf">Wolf</option>
                            <option value="dragon">Dragon</option>
                            <option value="phoenix">Phoenix</option>
                            <option value="unicorn">Unicorn</option>
                        </select>
                        @error('animation_spirit')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Transformation Phrase -->
                    <div>
                        <label for="transformation_phrase" class="block text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">
                            Transformation Phrase <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="transformation_phrase" 
                            id="transformation_phrase" 
                            x-model="transformationPhrase"
                            rows="3" 
                            class="block w-full px-4 py-3 border border-blue-200 dark:border-blue-800 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 bg-blue-50/50 dark:bg-blue-900/20 text-blue-900 dark:text-blue-100"
                            placeholder="What you say when transforming"
                        ></textarea>
                        @error('transformation_phrase')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Character Biography -->
                    <div>
                        <label for="bio" class="block text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">
                            Character Biography <span class="text-gray-500 dark:text-gray-400 font-normal">(optional)</span>
                        </label>
                        <textarea 
                            name="bio" 
                            id="bio" 
                            x-model="bio"
                            rows="6" 
                            class="block w-full px-4 py-3 border border-blue-200 dark:border-blue-800 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 bg-blue-50/50 dark:bg-blue-900/20 text-blue-900 dark:text-blue-100"
                            placeholder="Write your character's story..."
                        ></textarea>
                        @error('bio')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Step 2: Attributes -->
            <div x-show="currentStep === 2" class="transition-all duration-300">
                <h3 class="text-xl font-semibold text-blue-900 dark:text-blue-100 mb-6">Step 2: Choose Your Attributes</h3>
                
                <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg mb-6">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm text-blue-700 dark:text-blue-300">
                            Distribute a total of <span x-text="maxPoints" class="font-semibold"></span> points across all attributes. 
                            Each attribute must be between <span x-text="minAttribute" class="font-semibold"></span> and <span x-text="maxAttribute" class="font-semibold"></span>.
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between items-center">
                        <div class="text-sm text-blue-700 dark:text-blue-300">
                            <span class="font-semibold">Points used:</span> <span x-text="totalPoints" class="font-semibold" :class="totalPoints > maxPoints ? 'text-red-500' : (totalPoints < maxPoints ? 'text-yellow-500' : 'text-green-500')"></span>/<span x-text="maxPoints"></span>
                        </div>
                        <div x-show="totalPoints !== maxPoints" class="text-sm" :class="totalPoints > maxPoints ? 'text-red-500' : 'text-yellow-500'">
                            <span x-show="totalPoints > maxPoints">Please remove <span x-text="totalPoints - maxPoints"></span> points</span>
                            <span x-show="totalPoints < maxPoints">Please add <span x-text="maxPoints - totalPoints"></span> more points</span>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-8">
                    <!-- Focus Attribute -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                Focus <span class="text-gray-500 dark:text-gray-400 font-normal">(Concentration, Willpower, Mental Endurance)</span>
                            </label>
                            <div class="flex items-center space-x-2">
                                <button 
                                    type="button" 
                                    @click="decrementAttribute('focus')" 
                                    class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 flex items-center justify-center hover:bg-blue-200 dark:hover:bg-blue-800/50 transition-colors"
                                    :disabled="focus <= minAttribute"
                                    :class="{'opacity-50 cursor-not-allowed': focus <= minAttribute}"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </button>
                                <span x-text="focus" class="text-lg font-semibold w-6 text-center"></span>
                                <button 
                                    type="button" 
                                    @click="incrementAttribute('focus')" 
                                    class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 flex items-center justify-center hover:bg-blue-200 dark:hover:bg-blue-800/50 transition-colors"
                                    :disabled="focus >= maxAttribute || totalPoints >= maxPoints"
                                    :class="{'opacity-50 cursor-not-allowed': focus >= maxAttribute || totalPoints >= maxPoints}"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                            <div class="bg-blue-600 dark:bg-blue-500 h-2.5 rounded-full" :style="'width: ' + ((focus/maxAttribute)*100) + '%'"></div>
                        </div>
                        <input type="hidden" name="focus" :value="focus">
                    </div>
                    
                    <!-- Daring Attribute -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                Daring <span class="text-gray-500 dark:text-gray-400 font-normal">(Courage, Initiative, Risk-taking)</span>
                            </label>
                            <div class="flex items-center space-x-2">
                                <button 
                                    type="button" 
                                    @click="decrementAttribute('daring')" 
                                    class="w-8 h-8 rounded-full bg-pink-100 dark:bg-pink-900/50 text-pink-600 dark:text-pink-400 flex items-center justify-center hover:bg-pink-200 dark:hover:bg-pink-800/50 transition-colors"
                                    :disabled="daring <= minAttribute"
                                    :class="{'opacity-50 cursor-not-allowed': daring <= minAttribute}"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </button>
                                <span x-text="daring" class="text-lg font-semibold w-6 text-center"></span>
                                <button 
                                    type="button" 
                                    @click="incrementAttribute('daring')" 
                                    class="w-8 h-8 rounded-full bg-pink-100 dark:bg-pink-900/50 text-pink-600 dark:text-pink-400 flex items-center justify-center hover:bg-pink-200 dark:hover:bg-pink-800/50 transition-colors"
                                    :disabled="daring >= maxAttribute || totalPoints >= maxPoints"
                                    :class="{'opacity-50 cursor-not-allowed': daring >= maxAttribute || totalPoints >= maxPoints}"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                            <div class="bg-pink-600 dark:bg-pink-500 h-2.5 rounded-full" :style="'width: ' + ((daring/maxAttribute)*100) + '%'"></div>
                        </div>
                        <input type="hidden" name="daring" :value="daring">
                    </div>
                    
                    <!-- Insight Attribute -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                Insight <span class="text-gray-500 dark:text-gray-400 font-normal">(Perception, Intuition, Wisdom)</span>
                            </label>
                            <div class="flex items-center space-x-2">
                                <button 
                                    type="button" 
                                    @click="decrementAttribute('insight')" 
                                    class="w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900/50 text-purple-600 dark:text-purple-400 flex items-center justify-center hover:bg-purple-200 dark:hover:bg-purple-800/50 transition-colors"
                                    :disabled="insight <= minAttribute"
                                    :class="{'opacity-50 cursor-not-allowed': insight <= minAttribute}"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </button>
                                <span x-text="insight" class="text-lg font-semibold w-6 text-center"></span>
                                <button 
                                    type="button" 
                                    @click="incrementAttribute('insight')" 
                                    class="w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900/50 text-purple-600 dark:text-purple-400 flex items-center justify-center hover:bg-purple-200 dark:hover:bg-purple-800/50 transition-colors"
                                    :disabled="insight >= maxAttribute || totalPoints >= maxPoints"
                                    :class="{'opacity-50 cursor-not-allowed': insight >= maxAttribute || totalPoints >= maxPoints}"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                            <div class="bg-purple-600 dark:bg-purple-500 h-2.5 rounded-full" :style="'width: ' + ((insight/maxAttribute)*100) + '%'"></div>
                        </div>
                        <input type="hidden" name="insight" :value="insight">
                    </div>
                    
                    <!-- Presence Attribute -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                Presence <span class="text-gray-500 dark:text-gray-400 font-normal">(Charisma, Influence, Social Impact)</span>
                            </label>
                            <div class="flex items-center space-x-2">
                                <button 
                                    type="button" 
                                    @click="decrementAttribute('presence')" 
                                    class="w-8 h-8 rounded-full bg-cyan-100 dark:bg-cyan-900/50 text-cyan-600 dark:text-cyan-400 flex items-center justify-center hover:bg-cyan-200 dark:hover:bg-cyan-800/50 transition-colors"
                                    :disabled="presence <= minAttribute"
                                    :class="{'opacity-50 cursor-not-allowed': presence <= minAttribute}"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </button>
                                <span x-text="presence" class="text-lg font-semibold w-6 text-center"></span>
                                <button 
                                    type="button" 
                                    @click="incrementAttribute('presence')" 
                                    class="w-8 h-8 rounded-full bg-cyan-100 dark:bg-cyan-900/50 text-cyan-600 dark:text-cyan-400 flex items-center justify-center hover:bg-cyan-200 dark:hover:bg-cyan-800/50 transition-colors"
                                    :disabled="presence >= maxAttribute || totalPoints >= maxPoints"
                                    :class="{'opacity-50 cursor-not-allowed': presence >= maxAttribute || totalPoints >= maxPoints}"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                            <div class="bg-cyan-600 dark:bg-cyan-500 h-2.5 rounded-full" :style="'width: ' + ((presence/maxAttribute)*100) + '%'"></div>
                        </div>
                        <input type="hidden" name="presence" :value="presence">
                    </div>
                    
                    <!-- Might Attribute -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                Might <span class="text-gray-500 dark:text-gray-400 font-normal">(Strength, Endurance, Physical Power)</span>
                            </label>
                            <div class="flex items-center space-x-2">
                                <button 
                                    type="button" 
                                    @click="decrementAttribute('might')" 
                                    class="w-8 h-8 rounded-full bg-red-100 dark:bg-red-900/50 text-red-600 dark:text-red-400 flex items-center justify-center hover:bg-red-200 dark:hover:bg-red-800/50 transition-colors"
                                    :disabled="might <= minAttribute"
                                    :class="{'opacity-50 cursor-not-allowed': might <= minAttribute}"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </button>
                                <span x-text="might" class="text-lg font-semibold w-6 text-center"></span>
                                <button 
                                    type="button" 
                                    @click="incrementAttribute('might')" 
                                    class="w-8 h-8 rounded-full bg-red-100 dark:bg-red-900/50 text-red-600 dark:text-red-400 flex items-center justify-center hover:bg-red-200 dark:hover:bg-red-800/50 transition-colors"
                                    :disabled="might >= maxAttribute || totalPoints >= maxPoints"
                                    :class="{'opacity-50 cursor-not-allowed': might >= maxAttribute || totalPoints >= maxPoints}"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                            <div class="bg-red-600 dark:bg-red-500 h-2.5 rounded-full" :style="'width: ' + ((might/maxAttribute)*100) + '%'"></div>
                        </div>
                        <input type="hidden" name="might" :value="might">
                    </div>
                </div>
                
                <!-- Derived Stats -->
                <div class="mt-8 pt-6 border-t border-blue-200 dark:border-blue-800">
                    <h4 class="text-lg font-medium text-blue-900 dark:text-blue-100 mb-4">Derived Stats</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Stress -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Stress (Mental Resilience)</div>
                            <div class="text-2xl font-semibold text-purple-600 dark:text-purple-400" x-text="stress"></div>
                        </div>
                        
                        <!-- Harm -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Harm (Physical Endurance)</div>
                            <div class="text-2xl font-semibold text-red-600 dark:text-red-400" x-text="harm"></div>
                        </div>
                        
                        <!-- Physical Defense -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Physical Defense</div>
                            <div class="text-2xl font-semibold text-amber-600 dark:text-amber-400" x-text="physicalDefense"></div>
                        </div>
                        
                        <!-- Magical Defense -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Magical Defense</div>
                            <div class="text-2xl font-semibold text-blue-600 dark:text-blue-400" x-text="magicalDefense"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Step 3: Skills -->
            <div x-show="currentStep === 3" class="transition-all duration-300">
                <h3 class="text-xl font-semibold text-blue-900 dark:text-blue-100 mb-6">Step 3: Select Your Skills</h3>
                
                <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg mb-6">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm text-blue-700 dark:text-blue-300">
                            Choose 5 skills to be proficient in, and 2 of those to be mastered. Mastered skills must be selected from your proficient skills.
                        </p>
                    </div>
                    <div class="mt-2 flex justify-between items-center">
                        <div class="text-sm text-blue-700 dark:text-blue-300">
                            <span class="font-semibold">Proficient skills:</span> <span x-text="proficientSkills.length" class="font-semibold" :class="proficientSkills.length !== 5 ? 'text-yellow-500' : 'text-green-500'"></span>/5
                        </div>
                        <div class="text-sm text-blue-700 dark:text-blue-300">
                            <span class="font-semibold">Mastered skills:</span> <span x-text="masteredSkills.length" class="font-semibold" :class="masteredSkills.length !== 2 ? 'text-yellow-500' : 'text-green-500'"></span>/2
                        </div>
                    </div>
                </div>
                
                <!-- Skills Selection -->
                <div class="space-y-8">
                    <!-- Focus Skills -->
                    <div>
                        <h4 class="text-lg font-medium text-blue-900 dark:text-blue-100 mb-4">Focus Skills</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($skillsByAttribute['focus'] ?? [] as $skill)
                                <div class="flex items-center p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    <div class="flex-grow">
                                        <h5 class="font-medium text-blue-900 dark:text-blue-100">{{ $skill['name'] }}</h5>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $skill['description'] }}</p>
                                    </div>
                                    <div class="flex flex-col items-center space-y-2 ml-4">
                                        <button 
                                            type="button"
                                            @click="toggleProficientSkill('{{ $skill['id'] }}')"
                                            class="w-8 h-8 rounded-full border-2 flex items-center justify-center transition-colors"
                                            :class="proficientSkills.includes('{{ $skill['id'] }}') ? 'bg-blue-600 dark:bg-blue-500 border-blue-600 dark:border-blue-500 text-white' : 'border-blue-400 dark:border-blue-600 text-transparent hover:bg-blue-50 dark:hover:bg-blue-900/20'"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                        <button 
                                            type="button"
                                            @click="toggleMasteredSkill('{{ $skill['id'] }}')"
                                            class="w-8 h-8 rounded-full border-2 flex items-center justify-center transition-colors"
                                            :class="masteredSkills.includes('{{ $skill['id'] }}') ? 'bg-purple-600 dark:bg-purple-500 border-purple-600 dark:border-purple-500 text-white' : (proficientSkills.includes('{{ $skill['id'] }}') ? 'border-purple-400 dark:border-purple-600 text-transparent hover:bg-purple-50 dark:hover:bg-purple-900/20' : 'border-gray-300 dark:border-gray-700 text-transparent opacity-50 cursor-not-allowed')"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Daring Skills -->
                    <div>
                        <h4 class="text-lg font-medium text-blue-900 dark:text-blue-100 mb-4">Daring Skills</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($skillsByAttribute['daring'] ?? [] as $skill)
                                <div class="flex items-center p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    <div class="flex-grow">
                                        <h5 class="font-medium text-blue-900 dark:text-blue-100">{{ $skill['name'] }}</h5>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $skill['description'] }}</p>
                                    </div>
                                    <div class="flex flex-col items-center space-y-2 ml-4">
                                        <button 
                                            type="button"
                                            @click="toggleProficientSkill('{{ $skill['id'] }}')"
                                            class="w-8 h-8 rounded-full border-2 flex items-center justify-center transition-colors"
                                            :class="proficientSkills.includes('{{ $skill['id'] }}') ? 'bg-pink-600 dark:bg-pink-500 border-pink-600 dark:border-pink-500 text-white' : 'border-pink-400 dark:border-pink-600 text-transparent hover:bg-pink-50 dark:hover:bg-pink-900/20'"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                        <button 
                                            type="button"
                                            @click="toggleMasteredSkill('{{ $skill['id'] }}')"
                                            class="w-8 h-8 rounded-full border-2 flex items-center justify-center transition-colors"
                                            :class="masteredSkills.includes('{{ $skill['id'] }}') ? 'bg-purple-600 dark:bg-purple-500 border-purple-600 dark:border-purple-500 text-white' : (proficientSkills.includes('{{ $skill['id'] }}') ? 'border-purple-400 dark:border-purple-600 text-transparent hover:bg-purple-50 dark:hover:bg-purple-900/20' : 'border-gray-300 dark:border-gray-700 text-transparent opacity-50 cursor-not-allowed')"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Insight Skills -->
                    <div>
                        <h4 class="text-lg font-medium text-blue-900 dark:text-blue-100 mb-4">Insight Skills</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($skillsByAttribute['insight'] ?? [] as $skill)
                                <div class="flex items-center p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    <div class="flex-grow">
                                        <h5 class="font-medium text-blue-900 dark:text-blue-100">{{ $skill['name'] }}</h5>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $skill['description'] }}</p>
                                    </div>
                                    <div class="flex flex-col items-center space-y-2 ml-4">
                                        <button 
                                            type="button"
                                            @click="toggleProficientSkill('{{ $skill['id'] }}')"
                                            class="w-8 h-8 rounded-full border-2 flex items-center justify-center transition-colors"
                                            :class="proficientSkills.includes('{{ $skill['id'] }}') ? 'bg-purple-600 dark:bg-purple-500 border-purple-600 dark:border-purple-500 text-white' : 'border-purple-400 dark:border-purple-600 text-transparent hover:bg-purple-50 dark:hover:bg-purple-900/20'"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                        <button 
                                            type="button"
                                            @click="toggleMasteredSkill('{{ $skill['id'] }}')"
                                            class="w-8 h-8 rounded-full border-2 flex items-center justify-center transition-colors"
                                            :class="masteredSkills.includes('{{ $skill['id'] }}') ? 'bg-purple-600 dark:bg-purple-500 border-purple-600 dark:border-purple-500 text-white' : (proficientSkills.includes('{{ $skill['id'] }}') ? 'border-purple-400 dark:border-purple-600 text-transparent hover:bg-purple-50 dark:hover:bg-purple-900/20' : 'border-gray-300 dark:border-gray-700 text-transparent opacity-50 cursor-not-allowed')"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Presence Skills -->
                    <div>
                        <h4 class="text-lg font-medium text-blue-900 dark:text-blue-100 mb-4">Presence Skills</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($skillsByAttribute['presence'] ?? [] as $skill)
                                <div class="flex items-center p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    <div class="flex-grow">
                                        <h5 class="font-medium text-blue-900 dark:text-blue-100">{{ $skill['name'] }}</h5>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $skill['description'] }}</p>
                                    </div>
                                    <div class="flex flex-col items-center space-y-2 ml-4">
                                        <button 
                                            type="button"
                                            @click="toggleProficientSkill('{{ $skill['id'] }}')"
                                            class="w-8 h-8 rounded-full border-2 flex items-center justify-center transition-colors"
                                            :class="proficientSkills.includes('{{ $skill['id'] }}') ? 'bg-cyan-600 dark:bg-cyan-500 border-cyan-600 dark:border-cyan-500 text-white' : 'border-cyan-400 dark:border-cyan-600 text-transparent hover:bg-cyan-50 dark:hover:bg-cyan-900/20'"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                        <button 
                                            type="button"
                                            @click="toggleMasteredSkill('{{ $skill['id'] }}')"
                                            class="w-8 h-8 rounded-full border-2 flex items-center justify-center transition-colors"
                                            :class="masteredSkills.includes('{{ $skill['id'] }}') ? 'bg-purple-600 dark:bg-purple-500 border-purple-600 dark:border-purple-500 text-white' : (proficientSkills.includes('{{ $skill['id'] }}') ? 'border-purple-400 dark:border-purple-600 text-transparent hover:bg-purple-50 dark:hover:bg-purple-900/20' : 'border-gray-300 dark:border-gray-700 text-transparent opacity-50 cursor-not-allowed')"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Might Skills -->
                    <div>
                        <h4 class="text-lg font-medium text-blue-900 dark:text-blue-100 mb-4">Might Skills</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($skillsByAttribute['might'] ?? [] as $skill)
                                <div class="flex items-center p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    <div class="flex-grow">
                                        <h5 class="font-medium text-blue-900 dark:text-blue-100">{{ $skill['name'] }}</h5>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $skill['description'] }}</p>
                                    </div>
                                    <div class="flex flex-col items-center space-y-2 ml-4">
                                        <button 
                                            type="button"
                                            @click="toggleProficientSkill('{{ $skill['id'] }}')"
                                            class="w-8 h-8 rounded-full border-2 flex items-center justify-center transition-colors"
                                            :class="proficientSkills.includes('{{ $skill['id'] }}') ? 'bg-red-600 dark:bg-red-500 border-red-600 dark:border-red-500 text-white' : 'border-red-400 dark:border-red-600 text-transparent hover:bg-red-50 dark:hover:bg-red-900/20'"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                        <button 
                                            type="button"
                                            @click="toggleMasteredSkill('{{ $skill['id'] }}')"
                                            class="w-8 h-8 rounded-full border-2 flex items-center justify-center transition-colors"
                                            :class="masteredSkills.includes('{{ $skill['id'] }}') ? 'bg-purple-600 dark:bg-purple-500 border-purple-600 dark:border-purple-500 text-white' : (proficientSkills.includes('{{ $skill['id'] }}') ? 'border-purple-400 dark:border-purple-600 text-transparent hover:bg-purple-50 dark:hover:bg-purple-900/20' : 'border-gray-300 dark:border-gray-700 text-transparent opacity-50 cursor-not-allowed')"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- Hidden inputs for skills -->
                <template x-for="skill in proficientSkills">
                    <input type="hidden" name="proficient_skills[]" :value="skill">
                </template>
                
                <template x-for="skill in masteredSkills">
                    <input type="hidden" name="mastered_skills[]" :value="skill">
                </template>
            </div>
            
            <!-- Step 4: Review and Submit -->
            <div x-show="currentStep === 4" class="transition-all duration-300">
                <h3 class="text-xl font-semibold text-blue-900 dark:text-blue-100 mb-6">Step 4: Review Your Character</h3>
                
                <div class="relative p-1 bg-gradient-to-r" :style="'from-' + signatureColor + ' via-indigo-500 to-purple-500'" class="rounded-2xl">
                    <div class="bg-white dark:bg-gray-900 rounded-xl overflow-hidden">
                        <!-- Character Header -->
                        <div class="relative h-32 bg-gradient-to-r flex items-end" :style="'from-' + signatureColor + ' to-indigo-600'">
                            <div class="absolute inset-0 opacity-20">
                                <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-black/50 to-transparent"></div>
                            </div>
                            
                            <div class="relative w-full p-6 text-white flex justify-between items-end">
                                <div>
                                    <h2 class="text-2xl font-bold" x-text="magicalName"></h2>
                                    <p class="text-white/80">Civilian Identity: <span x-text="characterName"></span></p>
                                </div>
                                <div class="flex flex-col items-end">
                                    <div class="px-4 py-1 bg-white/20 backdrop-blur-sm rounded-full mb-2">
                                        <span class="text-sm font-medium" x-text="animationSpirit + ' Spirit'"></span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <div class="h-6 w-6 rounded-full" :style="'background-color: ' + signatureColor"></div>
                                        <span class="font-medium" x-text="signatureColor"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Character Details -->
                        <div class="p-6">
                            <!-- Transformation Phrase -->
                            <div class="mb-8 p-4 bg-indigo-100 dark:bg-indigo-900/20 border border-indigo-200 dark:border-indigo-800/30 rounded-lg">
                                <h3 class="text-lg font-medium text-indigo-800 dark:text-indigo-200 mb-2">
                                    Transformation Phrase
                                </h3>
                                <p class="text-indigo-700 dark:text-indigo-300 italic" x-text="'\"' + transformationPhrase + '\"'"></p>
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
                                                <span class="text-sm font-medium text-blue-900 dark:text-blue-100" x-text="focus"></span>
                                            </div>
                                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                                <div class="bg-blue-600 dark:bg-blue-500 h-2.5 rounded-full" :style="'width: ' + ((focus/maxAttribute)*100) + '%'"></div>
                                            </div>
                                        </div>
                                        
                                        <!-- Daring -->
                                        <div>
                                            <div class="flex justify-between items-center mb-1">
                                                <span class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                                    Daring
                                                </span>
                                                <span class="text-sm font-medium text-blue-900 dark:text-blue-100" x-text="daring"></span>
                                            </div>
                                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                                <div class="bg-pink-600 dark:bg-pink-500 h-2.5 rounded-full" :style="'width: ' + ((daring/maxAttribute)*100) + '%'"></div>
                                            </div>
                                        </div>
                                        
                                        <!-- Insight -->
                                        <div>
                                            <div class="flex justify-between items-center mb-1">
                                                <span class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                                    Insight
                                                </span>
                                                <span class="text-sm font-medium text-blue-900 dark:text-blue-100" x-text="insight"></span>
                                            </div>
                                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                                <div class="bg-purple-600 dark:bg-purple-500 h-2.5 rounded-full" :style="'width: ' + ((insight/maxAttribute)*100) + '%'"></div>
                                            </div>
                                        </div>
                                        
                                        <!-- Presence -->
                                        <div>
                                            <div class="flex justify-between items-center mb-1">
                                                <span class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                                    Presence
                                                </span>
                                                <span class="text-sm font-medium text-blue-900 dark:text-blue-100" x-text="presence"></span>
                                            </div>
                                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                                <div class="bg-cyan-600 dark:bg-cyan-500 h-2.5 rounded-full" :style="'width: ' + ((presence/maxAttribute)*100) + '%'"></div>
                                            </div>
                                        </div>
                                        
                                        <!-- Might -->
                                        <div>
                                            <div class="flex justify-between items-center mb-1">
                                                <span class="text-sm font-medium text-blue-900 dark:text-blue-100">
                                                    Might
                                                </span>
                                                <span class="text-sm font-medium text-blue-900 dark:text-blue-100" x-text="might"></span>
                                            </div>
                                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                                <div class="bg-red-600 dark:bg-red-500 h-2.5 rounded-full" :style="'width: ' + ((might/maxAttribute)*100) + '%'"></div>
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
                                            <div class="text-2xl font-semibold text-purple-600 dark:text-purple-400" x-text="stress"></div>
                                        </div>
                                        
                                        <!-- Harm -->
                                        <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Harm (Physical Endurance)</div>
                                            <div class="text-2xl font-semibold text-red-600 dark:text-red-400" x-text="harm"></div>
                                        </div>
                                        
                                        <!-- Physical Defense -->
                                        <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Physical Defense</div>
                                            <div class="text-2xl font-semibold text-amber-600 dark:text-amber-400" x-text="physicalDefense"></div>
                                        </div>
                                        
                                        <!-- Magical Defense -->
                                        <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Magical Defense</div>
                                            <div class="text-2xl font-semibold text-blue-600 dark:text-blue-400" x-text="magicalDefense"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Skills Summary -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-4">Skills</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Proficient Skills (excluding mastered) -->
                                    <div class="p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg border border-indigo-100 dark:border-indigo-800/30">
                                        <h4 class="font-medium text-indigo-800 dark:text-indigo-200 mb-3">Proficient Skills</h4>
                                        <ul class="space-y-2" id="proficientSkillsList">
                                            <!-- Will be filled by JavaScript -->
                                        </ul>
                                    </div>
                                    
                                    <!-- Mastered Skills -->
                                    <div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg border border-purple-100 dark:border-purple-800/30">
                                        <h4 class="font-medium text-purple-800 dark:text-purple-200 mb-3">Mastered Skills</h4>
                                        <ul class="space-y-2" id="masteredSkillsList">
                                            <!-- Will be filled by JavaScript -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Biography Section -->
                            <template x-if="bio">
                                <div>
                                    <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-4">Biography</h3>
                                    <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line" x-text="bio"></p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Navigation Buttons -->
            <div class="flex justify-between mt-8">
                <button 
                    type="button" 
                    @click="prevStep" 
                    x-show="currentStep > 1" 
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-700 dark:text-blue-300 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-blue-900/20 border border-blue-300 dark:border-blue-700 rounded-lg transition-colors"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Previous
                </button>
                
                <template x-if="currentStep < 4">
                    <button 
                        type="button" 
                        @click="nextStep" 
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:from-blue-600 hover:via-indigo-600 hover:to-purple-600 rounded-lg transition-colors"
                        :class="{ 'opacity-50 cursor-not-allowed': 
                            (currentStep === 1 && !validateStep1()) || 
                            (currentStep === 2 && !validateStep2()) || 
                            (currentStep === 3 && !validateStep3())
                        }"
                    >
                        Next
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </template>
                
                <button 
                    type="submit" 
                    x-show="currentStep === 4" 
                    class="inline-flex items-center px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 hover:from-pink-600 hover:via-purple-600 hover:to-indigo-600 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Create Magical Girl
                </button>
            </div>
        </div>
    </form>
    
    <!-- JavaScript to populate skills lists in review step -->
    <script>
        document.addEventListener('alpine:init', () => {
            // This code runs after Alpine.js has initialized
            
            // Get skill names from the server-side data
            const skillsData = @json($skillsByAttribute);
            const skillNames = {};
            
            // Create a mapping of skill IDs to names
            Object.keys(skillsData).forEach(attribute => {
                skillsData[attribute].forEach(skill => {
                    skillNames[skill.id] = skill.name;
                });
            });
            
            // Function to update the skills lists in the review step
            function updateSkillsLists(proficientSkills, masteredSkills) {
                const proficientList = document.getElementById('proficientSkillsList');
                const masteredList = document.getElementById('masteredSkillsList');
                
                if (proficientList && masteredList) {
                    // Clear existing lists
                    proficientList.innerHTML = '';
                    masteredList.innerHTML = '';
                    
                    // Filter proficient skills to exclude mastered ones
                    const onlyProficient = proficientSkills.filter(id => !masteredSkills.includes(id));
                    
                    // Populate proficient skills list
                    onlyProficient.forEach(skillId => {
                        const skillName = skillNames[skillId] || 'Unknown Skill';
                        proficientList.innerHTML += `
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">${skillName}</span>
                            </li>
                        `;
                    });
                    
                    // Populate mastered skills list
                    masteredSkills.forEach(skillId => {
                        const skillName = skillNames[skillId] || 'Unknown Skill';
                        masteredList.innerHTML += `
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300 font-medium">${skillName}</span>
                            </li>
                        `;
                    });
                }
            }
            
            // Watch for changes to skills and update the lists
            document.addEventListener('alpine:initialized', () => {
                Alpine.effect(() => {
                    const proficientSkills = document.querySelector('[x-data]').__x.$data.proficientSkills;
                    const masteredSkills = document.querySelector('[x-data]').__x.$data.masteredSkills;
                    
                    updateSkillsLists(proficientSkills, masteredSkills);
                });
            });
        });
    </script>
</div>