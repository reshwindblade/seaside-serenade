@props([
    'label' => null,
    'name' => null,
    'id' => null,
    'description' => null
])

<div class="flex items-start">
    <div class="flex items-center h-5">
        <input 
            {{ $attributes->whereStartsWith('wire:model') }} 
            id="{{ $id ?? '' }}" 
            name="{{ $name ?? '' }}" 
            type="checkbox" 
            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600 focus:ring-2"
            {{ $attributes->except(['wire:model', 'class']) }}
        >
    </div>
    
    @if($label || $description)
    <div class="ml-3 text-sm">
        @if($label)
        <label for="{{ $id ?? '' }}" class="font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
        @endif
        
        @if($description)
        <p class="text-gray-500 dark:text-gray-400">{{ $description }}</p>
        @endif
    </div>
    @endif
</div>