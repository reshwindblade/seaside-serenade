@props([
    'label' => '',
    'value' => '',
    'icon' => null,
    'color' => 'blue',
    'trend' => null,
    'trendValue' => null,
    'trendDirection' => null
])

@php
    $colorClasses = match ($color) {
        'blue' => 'bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400',
        'green' => 'bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400',
        'red' => 'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400',
        'amber' => 'bg-amber-100 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400',
        'purple' => 'bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400',
        'indigo' => 'bg-indigo-100 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400',
    };
    
    $trendColorClasses = match ($trendDirection ?? '') {
        'up' => 'text-green-600 dark:text-green-400',
        'down' => 'text-red-600 dark:text-red-400',
        default => 'text-gray-600 dark:text-gray-400',
    };
@endphp

<div {{ $attributes->merge(['class' => 'stat-card bg-white dark:bg-gray-800']) }}>
    @if($icon)
    <div class="stat-icon {{ $colorClasses }}">
        {{ $icon }}
    </div>
    @endif
    
    <div class="flex flex-col">
        <p class="stat-label">{{ $label }}</p>
        <p class="stat-value">{{ $value }}</p>
        
        @if($trend && $trendValue)
        <div class="flex items-center mt-1">
            @if($trendDirection === 'up')
            <svg class="w-4 h-4 {{ $trendColorClasses }} mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
            </svg>
            @elseif($trendDirection === 'down')
            <svg class="w-4 h-4 {{ $trendColorClasses }} mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path>
            </svg>
            @endif
            <span class="text-xs {{ $trendColorClasses }}">{{ $trendValue }} {{ $trend }}</span>
        </div>
        @endif
    </div>
</div>