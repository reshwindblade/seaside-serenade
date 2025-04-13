@props([
    'type' => 'primary', 
    'size' => 'md', 
    'tag' => 'button',
    'href' => '/',
    'submit' => false,
    'rounded' => 'md',
    'icon' => false,
    'loading' => false
])
@php
    $typeClasses = match ($type) {
        'primary' => 'btn-enhanced btn-primary',
        'secondary' => 'btn-enhanced btn-secondary',
        'success' => 'btn-enhanced btn-success',
        'danger' => 'btn-enhanced btn-danger',
        'info' => 'btn-enhanced btn-info',
        'warning' => 'btn-enhanced btn-warning',
        default => 'btn-enhanced btn-primary',  // Add default case
    };
    $sizeClasses = match ($size) {
        'sm' => 'btn-enhanced btn-sm',
        'md' => 'btn-enhanced btn-md',
        'lg' => 'btn-enhanced btn-lg',
        default => 'btn-enhanced btn-md',  // Add default case
    };
    $roundedClasses = match ($rounded) {
        'full' => 'rounded-full',
        'md' => 'rounded-md',
        'lg' => 'rounded-lg',
        'none' => 'rounded-none',
        default => 'rounded-md',  // Add default case
    };

    $isAnchor = $tag === 'a';
    $buttonTag = $isAnchor ? 'a' : 'button';
@endphp
<{{ $buttonTag }} 
    @if($isAnchor)
        href="{{ $href }}"
    @endif
    @if(!$isAnchor)
        type="{{ $submit ? 'submit' : 'button' }}"
    @endif
    {{ $attributes->merge(['class' => "$typeClasses $sizeClasses $roundedClasses"]) }}
>
    @if($loading)
        <svg class="inline w-4 h-4 mr-2 -ml-1 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    @elseif($icon)
        <span class="mr-2">{{ $icon }}</span>
    @endif
    {{ $slot }}
</{{ $buttonTag }}>