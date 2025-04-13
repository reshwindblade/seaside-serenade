@props([
    'href' => '/',
    'active' => null,
    'icon' => false
])

@php
    $isActive = $active ?? Request::is((($href == '/') ? '/' : trim($href, '/')));
    $activeClasses = $isActive 
        ? 'active text-blue-600 dark:text-blue-500 bg-blue-50 dark:bg-blue-900/20' 
        : 'text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-800/50';
@endphp

<a 
    {{ $attributes->merge(['class' => "nav-link-enhanced $activeClasses flex items-center"]) }}
    href="{{ $href }}"
>
    @if($icon)
    <span class="mr-2 text-gray-500 dark:text-gray-400 {{ $isActive ? 'text-blue-500 dark:text-blue-400' : '' }}">
        {{ $icon }}
    </span>
    @endif
    
    <span>{{ $slot }}</span>
    
    @if($isActive)
    <span class="absolute inset-y-0 left-0 w-1 bg-blue-600 dark:bg-blue-500 rounded-r-md"></span>
    @endif
</a>