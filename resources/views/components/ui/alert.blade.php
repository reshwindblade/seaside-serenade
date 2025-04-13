@props([
    'type' => 'info',
    'title' => null,
    'dismissible' => false
])

@php
    $alertClasses = match ($type) {
        'success' => 'alert-enhanced alert-success',
        'danger' => 'alert-enhanced alert-danger',
        'warning' => 'alert-enhanced alert-warning',
        'info' => 'alert-enhanced alert-info',
    };
    
    $iconClasses = match ($type) {
        'success' => 'text-green-500 dark:text-green-400',
        'danger' => 'text-red-500 dark:text-red-400',
        'warning' => 'text-amber-500 dark:text-amber-400',
        'info' => 'text-blue-500 dark:text-blue-400',
    };
@endphp

<div 
    x-data="{ isVisible: true }" 
    x-show="isVisible" 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-2"
    {{ $attributes->merge(['class' => $alertClasses]) }}
>
    <div class="flex">
        <div class="flex-shrink-0">
            @if($type === 'success')
            <svg class="w-5 h-5 {{ $iconClasses }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            @elseif($type === 'danger')
            <svg class="w-5 h-5 {{ $iconClasses }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
            @elseif($type === 'warning')
            <svg class="w-5 h-5 {{ $iconClasses }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            @elseif($type === 'info')
            <svg class="w-5 h-5 {{ $iconClasses }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            @endif
        </div>
        
        <div class="ml-3 flex-1">
            @if($title)
            <h3 class="text-sm font-medium 
                {{ $type === 'success' ? 'text-green-800 dark:text-green-200' : '' }}
                {{ $type === 'danger' ? 'text-red-800 dark:text-red-200' : '' }}
                {{ $type === 'warning' ? 'text-amber-800 dark:text-amber-200' : '' }}
                {{ $type === 'info' ? 'text-blue-800 dark:text-blue-200' : '' }}
            ">
                {{ $title }}
            </h3>
            @endif
            
            <div class="text-sm 
                {{ $type === 'success' ? 'text-green-700 dark:text-green-300' : '' }}
                {{ $type === 'danger' ? 'text-red-700 dark:text-red-300' : '' }}
                {{ $type === 'warning' ? 'text-amber-700 dark:text-amber-300' : '' }}
                {{ $type === 'info' ? 'text-blue-700 dark:text-blue-300' : '' }}
            ">
                {{ $slot }}
            </div>
        </div>
        
        @if($dismissible)
        <div class="ml-auto pl-3">
            <div class="-mx-1.5 -my-1.5">
                <button 
                    type="button" 
                    @click="isVisible = false" 
                    class="inline-flex p-1.5 rounded-md 
                        {{ $type === 'success' ? 'text-green-500 hover:bg-green-100 focus:bg-green-100 dark:text-green-300 dark:hover:bg-green-800' : '' }}
                        {{ $type === 'danger' ? 'text-red-500 hover:bg-red-100 focus:bg-red-100 dark:text-red-300 dark:hover:bg-red-800' : '' }}
                        {{ $type === 'warning' ? 'text-amber-500 hover:bg-amber-100 focus:bg-amber-100 dark:text-amber-300 dark:hover:bg-amber-800' : '' }}
                        {{ $type === 'info' ? 'text-blue-500 hover:bg-blue-100 focus:bg-blue-100 dark:text-blue-300 dark:hover:bg-blue-800' : '' }}
                        focus:outline-none"
                >
                    <span class="sr-only">Dismiss</span>
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
        @endif
    </div>
</div>