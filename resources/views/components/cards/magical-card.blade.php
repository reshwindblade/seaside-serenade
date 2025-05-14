@props([
    'color' => 'blue',
    'hover' => true
])

<div {{ $attributes->merge(['class' => 'magical-card overflow-hidden ' . ($hover ? 'transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1' : '')]) }}>
    @if(isset($header))
        {{ $header }}
    @else
        <div class="h-2 bg-gradient-to-r from-{{ $color }}-500 via-indigo-500 to-purple-500"></div>
    @endif
    
    <div class="p-6">
        {{ $slot }}
    </div>
    
    @if(isset($footer))
        <div class="px-6 py-4 bg-{{ $color }}-50 dark:bg-{{ $color }}-900/20 border-t border-gray-200 dark:border-gray-700">
            {{ $footer }}
        </div>
    @endif
</div>
