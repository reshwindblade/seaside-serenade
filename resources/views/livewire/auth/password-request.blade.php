{{-- resources/views/livewire/auth/password-request.blade.php --}}
<div>
    <div class="mb-8">
        <div class="p-3 mx-auto w-16 h-16 flex items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
    </div>
    
    @if (session('status'))
        <div class="mb-8 p-4 bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-800 rounded-lg text-green-700 dark:text-green-300">
            {{ session('status') }}
        </div>
    @endif
    
    <form wire:submit="sendResetLink" class="space-y-6">
        <!-- Email Field -->
        <div>
            <label for="email" class="block text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">
                Email Address
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <input 
                    wire:model="email" 
                    id="email" 
                    name="email" 
                    type="email" 
                    autocomplete="email" 
                    required 
                    placeholder="your.email@example.com"
                    class="block w-full pl-10 pr-3 py-3 border border-blue-200 dark:border-blue-800 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 bg-blue-50/50 dark:bg-blue-900/20 text-blue-900 dark:text-blue-100 placeholder-blue-400/70 dark:placeholder-blue-500/70 transition-colors duration-200"
                >
            </div>
            @error('email')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Submit Button -->
        <div>
            <button 
                type="submit" 
                class="relative overflow-hidden group w-full flex justify-center py-3 px-4 border border-transparent rounded-xl font-medium text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-blue-700/30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 transition-all duration-300 hover:scale-[1.02]"
            >
                <span class="relative z-10">Send Reset Link</span>
                <span class="absolute inset-0 overflow-hidden rounded-xl">
                    <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-80"></span>
                </span>
            </button>
        </div>
        
        <!-- Back to Login Link -->
        <div class="text-center mt-6">
            <a href="{{ route('login') }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors duration-200">
                Back to login
            </a>
        </div>
    </form>
</div>