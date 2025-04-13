@props([
    'type' => 'primary',
    'size' => 'md',
    'icon' => false,
    'dot' => false
])

@php
    $typeClasses = match ($type) {
        'primary' => 'badge-enhanced badge-primary',
        'success' => 'badge-enhanced badge-success',
        'danger' => 'badge-enhanced badge-danger',
        'warning' => 'badge-enhanced badge-warning',
        'info' => 'badge-enhanced badge-info',
    };
    
    $sizeClasses = match ($size) {
        'sm' => 'text-xs',
        'md' => 'text-sm',
        'lg' => 'text-base',
    };
@endphp

<span {{ $attributes->merge(['class' => "$typeClasses $sizeClasses flex items-center"]) }}>
    @if($dot)
    <span class="flex-shrink-0 w-2 h-2 rounded-full mr-1.5 
        {{$type === 'primary' ? 'bg-blue-600 dark:bg-blue-400' : ''}}
        {{$type === 'success' ? 'bg-green-600 dark:bg-green-400' : ''}}  
        {{$type === 'danger' ? 'bg-red-600 dark:bg-red-400' : ''}}
        {{$type === 'warning' ? 'bg-amber-600 dark:bg-amber-400' : ''}}
        {{$type === 'info' ? 'bg-indigo-600 dark:bg-indigo-400' : ''}}
    "></span>
    @endif
    
    @if($icon)
    <span class="mr-1">{{ $icon }}</span>
    @endif
    
    {{ $slot }}
</span>