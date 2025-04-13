@props([
    'title' => null,
    'description' => null,
    'footer' => false,
    'glass' => false,
    'hover' => true,
    'padding' => 'normal'
])

@php
    $cardClasses = $glass 
        ? 'glass-card' 
        : 'sleek-card bg-white dark:bg-gray-800';
    
    $paddingClasses = match ($padding) {
        'none' => '',
        'sm' => 'p-4',
        'normal' => 'p-6',
        'lg' => 'p-8',
    };
    
    $hoverClass = $hover ? 'hover:shadow-lg' : '';
@endphp

<div {{ $attributes->merge(['class' => "$cardClasses $paddingClasses $hoverClass rounded-lg"]) }}>
    @if($title || $description)
    <div class="mb-4">
        @if($title)
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ $title }}
        </h3>
        @endif
        
        @if($description)
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            {{ $description }}
        </p>
        @endif
    </div>
    @endif
    
    <div>
        {{ $slot }}
    </div>
    
    @if($footer)
    <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
        {{ $footer }}
    </div>
    @endif
</div>