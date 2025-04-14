{{-- resources/views/pages/auth/login.blade.php --}}
<?php

use App\Models\User;
use Illuminate\Auth\Events\Login;
use function Laravel\Folio\{middleware, name};
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

middleware(['guest']);
name('login');

new class extends Component
{
    #[Validate('required|email')]
    public $email = '';

    #[Validate('required')]
    public $password = '';

    public $remember = false;

    public function authenticate()
    {
        // Check if new account creation is disabled
        if (config('app.disable_registration') && !User::where('email', $this->email)->exists()) {
            $this->addError('email', 'New account creation is currently disabled.');
            return;
        }

        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));

            return;
        }

        event(new Login(auth()->guard('web'), User::where('email', $this->email)->first(), $this->remember));

        return redirect()->intended('/');
    }
};

?>

<x-layouts.magical-ocean>
    <div 
        x-data="{ loaded: false }" 
        x-init="setTimeout(() => loaded = true, 100)" 
        class="flex min-h-screen items-center justify-center p-6"
    >
        <div class="absolute inset-0 z-0">
            <!-- Decorative background elements -->
            <div class="absolute top-20 left-1/4 w-64 h-64 rounded-full bg-blue-500/10 dark:bg-blue-500/5 blur-3xl"></div>
            <div class="absolute bottom-20 right-1/4 w-96 h-96 rounded-full bg-purple-500/10 dark:bg-purple-500/5 blur-3xl"></div>
        </div>
        
        <!-- Login Container -->
        <div class="w-full max-w-md z-10">
            <!-- Logo and Heading Section -->
            <div 
                x-show="loaded" 
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform -translate-y-12"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                class="text-center mb-10"
            >
                <a href="{{ route('home') }}" class="inline-block mb-6 transition-transform duration-300 hover:scale-110">
                    <x-ui.logo class="w-auto h-16 text-transparent fill-current dark:text-transparent" style="fill: url(#magical-login-gradient)" />
                    
                    {{-- SVG Gradient Definition --}}
                    <svg width="0" height="0">
                        <defs>
                            <linearGradient id="magical-login-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#1a91ff" />
                                <stop offset="50%" stop-color="#5643fd" />
                                <stop offset="100%" stop-color="#b54aff" />
                            </linearGradient>
                        </defs>
                    </svg>
                </a>
                
                <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 dark:from-blue-400 dark:via-indigo-400 dark:to-purple-400">
                    Welcome Back
                </h1>
                
                <p class="mt-3 text-blue-800/70 dark:text-blue-200/70">
                    Sign in to your magical ocean account
                    @if(!config('app.disable_registration'))
                        or <a href="{{ route('register') }}" class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors duration-300">create a new one</a>
                    @endif
                </p>
            </div>
            
            <!-- Login Card -->
            <div 
                x-show="loaded" 
                x-transition:enter="transition ease-out duration-500 delay-200"
                x-transition:enter-start="opacity-0 transform translate-y-12"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                class="relative"
            >
                <!-- Card with gradient border -->
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 rounded-2xl blur-[2px]"></div>
                
                <div class="relative bg-white dark:bg-gray-900 rounded-2xl shadow-xl overflow-hidden">
                    <!-- Visual element: wave decoration at the top -->
                    <div class="h-3 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>
                    
                    <!-- Login Form -->
                    @volt('auth.login')
                    <div class="p-8">
                        <form wire:submit="authenticate" class="space-y-6">
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
                                        :class="{ 'border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500': $wire.errors.has('email') }"
                                    >
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Password Field -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">
                                    Password
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input 
                                        wire:model="password" 
                                        id="password" 
                                        name="password" 
                                        type="password" 
                                        autocomplete="current-password" 
                                        required
                                        placeholder="••••••••"
                                        class="block w-full pl-10 pr-3 py-3 border border-blue-200 dark:border-blue-800 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400 bg-blue-50/50 dark:bg-blue-900/20 text-blue-900 dark:text-blue-100 placeholder-blue-400/70 dark:placeholder-blue-500/70 transition-colors duration-200"
                                    >
                                </div>
                            </div>
                            
                            <!-- Remember Me and Forgot Password Row -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input 
                                        wire:model="remember" 
                                        id="remember" 
                                        name="remember" 
                                        type="checkbox" 
                                        class="h-4 w-4 text-blue-600 border-blue-300 dark:border-blue-700 rounded focus:ring-blue-500 dark:focus:ring-blue-400 dark:bg-blue-900/30 transition-colors duration-200"
                                    >
                                    <label for="remember" class="ml-2 block text-sm text-blue-800/80 dark:text-blue-200/80">
                                        Remember me
                                    </label>
                                </div>
                                
                                <a href="{{ route('password.request') }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors duration-200">
                                    Forgot password?
                                </a>
                            </div>
                            
                            <!-- Submit Button -->
                            <div>
                                <button 
                                    type="submit" 
                                    class="relative overflow-hidden group w-full flex justify-center py-3 px-4 border border-transparent rounded-xl font-medium text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-blue-700/30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 transition-all duration-300 hover:scale-[1.02]"
                                >
                                    <span class="relative z-10">Sign in</span>
                                    <span class="absolute inset-0 overflow-hidden rounded-xl">
                                        <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-80"></span>
                                    </span>
                                </button>
                            </div>
                            
                            <!-- Social Login Section -->
                            @if(config('app.social_login.facebook.enabled') || config('app.social_login.google.enabled'))
                                <div class="mt-6">
                                    <div class="relative">
                                        <div class="absolute inset-0 flex items-center">
                                            <div class="w-full border-t border-blue-200 dark:border-blue-800"></div>
                                        </div>
                                        <div class="relative flex justify-center text-sm">
                                            <span class="px-2 bg-white dark:bg-gray-900 text-blue-800/70 dark:text-blue-200/70">
                                                Or continue with
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6 grid grid-cols-2 gap-3">
                                        @if(config('app.social_login.facebook.enabled'))
                                            <a href="{{ route('login.social', ['provider' => 'facebook']) }}" class="w-full flex justify-center py-2.5 px-4 border border-blue-300 dark:border-blue-800 rounded-xl shadow-sm bg-blue-50 dark:bg-blue-900/20 text-sm font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-800/30 transition-colors duration-200">
                                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.325V1.325C24 .593 23.407 0 22.675 0z"/>
                                                </svg>
                                            </a>
                                        @endif
                                        
                                        @if(config('app.social_login.google.enabled'))
                                            <a href="{{ route('login.social', ['provider' => 'google']) }}" class="w-full flex justify-center py-2.5 px-4 border border-blue-300 dark:border-blue-800 rounded-xl shadow-sm bg-blue-50 dark:bg-blue-900/20 text-sm font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-800/30 transition-colors duration-200">
                                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12.24 10.285V14.4h6.806c-.275 1.765-2.076 5.174-6.806 5.174-4.095 0-7.439-3.389-7.439-7.574s3.345-7.574 7.439-7.574c2.33 0 3.891.989 4.785 1.849l3.254-3.138C18.189 1.186 15.479 0 12.24 0c-6.635 0-12 5.365-12 12s5.365 12 12 12c6.926 0 11.52-4.875 11.52-11.745 0-.79-.085-1.39-.189-1.99H12.24z"/>
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                    @endvolt
                    
                    <!-- Visual element: bubbles decoration -->
                    <div aria-hidden="true" class="absolute top-5 right-5 w-6 h-6 rounded-full bg-blue-400/30 dark:bg-blue-400/20 floating"></div>
                    <div aria-hidden="true" class="absolute bottom-10 left-8 w-4 h-4 rounded-full bg-purple-400/30 dark:bg-purple-400/20 floating" style="animation-delay: 1s;"></div>
                    <div aria-hidden="true" class="absolute top-1/2 right-10 w-8 h-8 rounded-full bg-cyan-400/30 dark:bg-cyan-400/20 floating" style="animation-delay: 2s;"></div>
                </div>
            </div>
            
            <!-- Back to Home Link -->
            <div 
                x-show="loaded" 
                x-transition:enter="transition ease-out duration-500 delay-400"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                class="mt-6 text-center"
            >
                <a href="{{ route('home') }}" class="text-sm font-medium text-blue-800/70 dark:text-blue-200/70 hover:text-blue-900 dark:hover:text-blue-100 transition-colors duration-200">
                    <span class="inline-block mr-1">←</span> Back to home
                </a>
            </div>
        </div>
    </div>
</x-layouts.magical-ocean>