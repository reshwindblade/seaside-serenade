@props([
    'type' => 'button',
    'color' => 'primary',
    'size' => 'md',
    'submit' => false,
    'href' => null,
    'disabled' => false
])

@php
    $baseClasses = 'relative overflow-hidden group inline-flex items-center font-medium rounded-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900';
    
    $colorClasses = [
        'primary' => 'text-white bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 hover:shadow-lg hover:shadow-blue-500/20 dark:hover:shadow-blue-700/30 hover:scale-105',
        'secondary' => 'text-blue-600 dark:text-blue-300 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-blue-900/20 border border-blue-200 dark:border-blue-800 hover:scale-105',
        'danger' => 'text-white bg-red-600 hover:bg-red-700 focus:ring-red-500 dark:hover:shadow-red-700/30 border border-transparent hover:scale-105',
    ];
    
    $sizeClasses = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
    ];
    
    $classes = $baseClasses . ' ' . $colorClasses[$color] . ' ' . $sizeClasses[$size];
    
    if ($disabled) {
        $classes .= ' opacity-50 cursor-not-allowed';
    }
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        <span class="relative z-10">{{ $slot }}</span>
        @if($color === 'primary')
        <span class="absolute inset-0 overflow-hidden rounded-xl">
            <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-80"></span>
        </span>
        @endif
    </a>
@else
    <button 
        type="{{ $submit ? 'submit' : 'button' }}" 
        {{ $disabled ? 'disabled' : '' }}
        {{ $attributes->merge(['class' => $classes]) }}
    >
        <span class="relative z-10">{{ $slot }}</span>
        @if($color === 'primary')
        <span class="absolute inset-0 overflow-hidden rounded-xl">
            <span class="absolute -left-10 w-20 h-full bg-white/20 transform -skew-x-12 transition-all duration-1000 ease-out group-hover:translate-x-80"></span>
        </span>
        @endif
    </button>
@endif