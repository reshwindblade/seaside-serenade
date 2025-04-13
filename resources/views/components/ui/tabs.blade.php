@props([
    'variant' => 'border', // border, pill
    'tabs' => [],
    'active' => null
])

@php
    $tabsClass = match ($variant) {
        'border' => 'border-tabs',
        'pill' => 'pill-tabs',
    };
    
    $tabClass = match ($variant) {
        'border' => 'border-tab',
        'pill' => 'pill-tab',
    };
@endphp

<div x-data="{ activeTab: '{{ $active ?? array_key_first($tabs) }}' }">
    <div class="{{ $tabsClass }}">
        @foreach($tabs as $id => $label)
        <button
            @click="activeTab = '{{ $id }}'"
            :class="{'active': activeTab === '{{ $id }}'}"
            class="{{ $tabClass }}"
            type="button"
        >
            {{ $label }}
        </button>
        @endforeach
    </div>
    
    <div class="mt-4">
        {{ $slot }}
    </div>
</div>