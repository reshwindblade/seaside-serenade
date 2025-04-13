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

<x-layouts.main>
    <div class="flex flex-col items-stretch justify-center w-screen min-h-screen py-10 sm:items-center bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-950">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="flex justify-center mb-6">
                <x-ui.logo class="w-auto h-12 text-gray-800 fill-current dark:text-white" />
            </div>
            <h2 class="mt-2 text-3xl font-extrabold leading-9 text-center text-gray-900 dark:text-white">
                Sign in to your account
            </h2>
            <p class="mt-2 text-sm text-center text-gray-600 dark:text-gray-400">
                @if(!config('app.disable_registration'))
                    Or 
                    <x-ui.text-link href="{{ route('register') }}">create a new account</x-ui.text-link>
                @endif
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-8 py-10 bg-white shadow-2xl dark:bg-gray-800/60 sm:rounded-xl border border-gray-200 dark:border-gray-700/50">
                @volt('auth.login')
                <form wire:submit="authenticate" class="space-y-6">
                    <div class="space-y-6">
                        <x-ui.input 
                            label="Email address" 
                            type="email" 
                            id="email" 
                            name="email" 
                            wire:model="email"
                            placeholder="you@example.com"
                            class="transition-all duration-300 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400"
                        />
                        <x-ui.input 
                            label="Password" 
                            type="password" 
                            id="password" 
                            name="password" 
                            wire:model="password"
                            placeholder="Enter your password"
                            class="transition-all duration-300 focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400"
                        />
                    </div>

                    <div class="flex items-center justify-between mt-6 text-sm leading-5">
                        <x-ui.checkbox 
                            label="Remember me" 
                            id="remember" 
                            name="remember" 
                            wire:model="remember"
                            class="dark:text-gray-300"
                        />
                        <x-ui.text-link 
                            href="{{ route('password.request') }}" 
                            class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300"
                        >
                            Forgot your password?
                        </x-ui.text-link>
                    </div>

                    <x-ui.button 
                        type="primary" 
                        rounded="md" 
                        submit="true" 
                        class="w-full mt-6 transition-all duration-300 ease-in-out transform hover:scale-[1.02] active:scale-[0.98]"
                    >
                        Sign in
                    </x-ui.button>

                    <!-- Social Login Buttons -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300 dark:border-gray-700"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                                Or continue with
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        @if(config('app.social_login.facebook.enabled'))
                        <a href="{{ route('login.facebook') }}" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.325V1.325C24 .593 23.407 0 22.675 0z"/>
                            </svg>
                            Facebook
                        </a>
                        @endif
                        @if(config('app.social_login.google.enabled'))
                        <a href="{{ route('login.google') }}" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.24 10.285V14.4h6.806c-.275 1.765-2.076 5.174-6.806 5.174-4.095 0-7.439-3.389-7.439-7.574s3.345-7.574 7.439-7.574c2.33 0 3.891.989 4.785 1.849l3.254-3.138C18.189 1.186 15.479 0 12.24 0c-6.635 0-12 5.365-12 12s5.365 12 12 12c6.926 0 11.52-4.875 11.52-11.745 0-.790-.085-1.39-.189-1.99H12.24z"/>
                            </svg>
                            Google
                        </a>
                        @endif
                    </div>
                </form>
                @endvolt
            </div>
        </div>
    </div>
</x-layouts.main>