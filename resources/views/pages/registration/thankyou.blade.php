{{-- resources/views/pages/registration/thankyou.blade.php --}}
<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('registration.thankyou');
middleware(['auth']);

new class extends Component
{
};

?>

<x-layouts.magical-ocean>
    <div 
        x-data="{ loaded: false }" 
        x-init="setTimeout(() => loaded = true, 100)"
        class="flex min-h-screen items-center justify-center p-6 relative overflow-hidden"
    >
        {{-- Background decorative elements --}}
        <div class="absolute inset-0 z-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 rounded-full bg-blue-500/10 dark:bg-blue-500/5 blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 rounded-full bg-purple-500/10 dark:bg-purple-500/5 blur-3xl transform translate-x-1/2 translate-y-1/2"></div>
            
            {{-- Animated confetti particles --}}
            <div class="absolute inset-0 z-0 opacity-70" id="confetti-container"></div>
        </div>
        
        <div class="w-full max-w-2xl z-10">
            {{-- Success Card --}}
            <div 
                x-show="loaded"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                class="relative"
            >
                {{-- Card gradient border --}}
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 rounded-2xl blur-[2px]"></div>
                
                <div class="relative bg-white dark:bg-gray-900 rounded-2xl shadow-xl overflow-hidden">
                    {{-- Rainbow gradient top border --}}
                    <div class="h-2 bg-gradient-to-r from-blue-500 via-cyan-400 via-30% via-purple-500 via-70% to-pink-500"></div>
                    
                    <div class="p-8 text-center">
                        {{-- Success Icon --}}
                        <div class="flex justify-center mb-8">
                            <div class="relative">
                                <div class="absolute inset-0 rounded-full bg-gradient-to-r from-cyan-400 to-blue-500 blur-[2px] animate-pulse"></div>
                                <div class="relative w-24 h-24 flex items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-purple-500">
                                    <svg class="w-12 h-12 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                
                                {{-- Decorative rings --}}
                                <div class="absolute inset-0 rounded-full border-2 border-blue-500/50 dark:border-blue-400/30 scale-110 animate-ping" style="animation-duration: 2s;"></div>
                                <div class="absolute inset-0 rounded-full border-2 border-purple-500/50 dark:border-purple-400/30 scale-125 animate-ping" style="animation-duration: 3s;"></div>
                            </div>
                        </div>
                        
                        {{-- Success Message --}}
                        <h1 
                            class="text-3xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 dark:from-blue-400 dark:via-indigo-400 dark:to-purple-400"
                        >
                            Registration Successful!
                        </h1>
                        
                        <p class="text-lg text-blue-900/80 dark:text-blue-100/80 mb-8 max-w-lg mx-auto">
                            Welcome to the Magical Ocean Portal! Your account has been created successfully and you're now ready to begin your adventure.
                        </p>
                        
                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                            <a 
                                href="{{ route('admin.dashboard') }}" 
                                class="relative overflow-hidden group inline-flex items-center px-6 py-3 font-medium text-sm rounded-xl text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-blue-700/30 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 w-full sm:w-auto justify-center"
                            >
                                <span class="relative z-10">Go to Dashboard</span>
                                <span class="absolute inset-0 overflow-hidden rounded-xl">
                                    <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-60"></span>
                                </span>
                            </a>
                            
                            <a 
                                href="{{ route('home') }}" 
                                class="inline-flex items-center px-6 py-3 font-medium text-sm rounded-xl text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 hover:bg-blue-100 dark:hover:bg-blue-800/30 transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 w-full sm:w-auto justify-center"
                            >
                                Return to Home
                            </a>
                        </div>
                    </div>
                    
                    {{-- Decorative bubbles --}}
                    <div aria-hidden="true" class="absolute top-12 right-8 w-8 h-8 rounded-full bg-blue-400/30 dark:bg-blue-400/20 floating"></div>
                    <div aria-hidden="true" class="absolute bottom-16 left-10 w-6 h-6 rounded-full bg-purple-400/30 dark:bg-purple-400/20 floating" style="animation-delay: 1s;"></div>
                    <div aria-hidden="true" class="absolute top-1/3 right-12 w-4 h-4 rounded-full bg-cyan-400/30 dark:bg-cyan-400/20 floating" style="animation-delay: 2s;"></div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Confetti animation script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const confettiContainer = document.getElementById('confetti-container');
            const confettiCount = 100;
            const colors = ['#1a91ff', '#5643fd', '#00e2c3', '#ff5995', '#b54aff'];
            
            for (let i = 0; i < confettiCount; i++) {
                createConfetti(confettiContainer, colors);
            }
        });
        
        function createConfetti(container, colors) {
            const confetti = document.createElement('div');
            
            // Random properties
            const size = Math.floor(Math.random() * 10) + 5;
            const color = colors[Math.floor(Math.random() * colors.length)];
            const left = Math.floor(Math.random() * 100);
            const type = Math.floor(Math.random() * 3);
            
            // Set position and style
            confetti.style.position = 'absolute';
            confetti.style.left = `${left}%`;
            confetti.style.top = '-5%';
            confetti.style.opacity = (Math.random() * 0.5) + 0.5;
            
            // Set shape based on type
            if (type === 0) {
                // Circle
                confetti.style.width = `${size}px`;
                confetti.style.height = `${size}px`;
                confetti.style.borderRadius = '50%';
                confetti.style.backgroundColor = color;
            } else if (type === 1) {
                // Rectangle
                confetti.style.width = `${size}px`;
                confetti.style.height = `${size * 0.5}px`;
                confetti.style.backgroundColor = color;
            } else {
                // Star/triangle
                confetti.style.width = '0px';
                confetti.style.height = '0px';
                confetti.style.borderLeft = `${size/2}px solid transparent`;
                confetti.style.borderRight = `${size/2}px solid transparent`;
                confetti.style.borderBottom = `${size}px solid ${color}`;
            }
            
            // Animation
            const duration = Math.random() * 5 + 5;
            const rotation = Math.random() * 360;
            
            confetti.style.animation = `confettiFall ${duration}s linear forwards, confettiRotate ${duration/4}s linear infinite`;
            confetti.style.transform = `rotate(${rotation}deg)`;
            
            container.appendChild(confetti);
            
            // Remove after animation completes
            setTimeout(() => {
                container.removeChild(confetti);
                createConfetti(container, colors);
            }, duration * 1000);
        }
    </script>
    
    <style>
        @keyframes confettiFall {
            0% {
                top: -5%;
                transform: translateX(0) rotate(0deg);
            }
            25% {
                transform: translateX(15px) rotate(45deg);
            }
            50% {
                transform: translateX(-15px) rotate(90deg);
            }
            75% {
                transform: translateX(15px) rotate(135deg);
            }
            100% {
                top: 100%;
                transform: translateX(-15px) rotate(180deg);
            }
        }
        
        @keyframes confettiRotate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</x-layouts.magical-ocean>