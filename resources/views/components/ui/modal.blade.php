@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl',
    'closeButton' => true,
    'title' => null,
    'footer' => null,
])

@php
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
    '3xl' => 'sm:max-w-3xl',
    '4xl' => 'sm:max-w-4xl',
    '5xl' => 'sm:max-w-5xl',
    '6xl' => 'sm:max-w-6xl',
    '7xl' => 'sm:max-w-7xl',
    'full' => 'sm:max-w-full',
][$maxWidth];
@endphp

<div wire:key="{{ $name }}" wire:ignore class="relative">
    @teleport('body')
        <div
            x-data="{
                showModal: @js($show),
                focusables() {
                    // All focusable element types...
                    let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
                    return [...$el.querySelectorAll(selector)]
                        // All non-disabled elements...
                        .filter(el => ! el.hasAttribute('disabled'))
                },
                firstFocusable() { return this.focusables()[0] },
                lastFocusable() { return this.focusables().slice(-1)[0] },
                nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
                prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
                nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
                prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
            }"
            x-init="$watch('showModal', value => {
                if (value) {
                    document.body.classList.add('overflow-y-hidden');
                    {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
                } else {
                    document.body.classList.remove('overflow-y-hidden');
                }
            })"
            x-on:open-modal.window="$event.detail == '{{ $name }}' ? showModal = true : null"
            x-on:close.stop="showModal = false"
            x-on:keydown.escape.window="showModal = false"
            x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
            x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
            x-show="showModal" 
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto" 
            x-cloak
        >
            <div 
                x-show="showModal" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="showModal=false" 
                class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm"
            ></div>
            
            <div 
                x-show="showModal"
                x-trap.inert.noscroll="showModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative w-full {{ $maxWidth }} mx-auto my-8 bg-white dark:bg-gray-900 dark:border dark:border-gray-700 sm:rounded-lg shadow-xl overflow-hidden"
            >
                @if($title)
                <div class="modal-header-enhanced flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ $title }}
                    </h3>
                    
                    @if($closeButton)
                    <button @click="showModal=false" class="text-gray-400 hover:text-gray-500 dark:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-500 dark:focus:text-gray-400 transition-colors">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    @endif
                </div>
                @elseif($closeButton)
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button @click="showModal=false" class="text-gray-400 hover:text-gray-500 dark:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-500 dark:focus:text-gray-400 transition-colors">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                @endif

                <div class="modal-body-enhanced">
                    {{ $slot }}
                </div>
                
                @if($footer)
                <div class="modal-footer-enhanced">
                    {{ $footer }}
                </div>
                @endif
            </div>
        </div>
    @endteleport
</div>