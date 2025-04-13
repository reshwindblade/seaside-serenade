@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'type' => 'text',
    'placeholder' => '',
    'helpText' => '',
    'leadingIcon' => false,
    'trailingIcon' => false,
    'error' => false
])

@php 
    $wireModel = $attributes->get('wire:model'); 
    $errorClasses = $error || ($wireModel && $errors->has($wireModel)) 
        ? 'border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 dark:border-red-500/50 dark:text-red-400 dark:placeholder-red-400' 
        : '';
    $iconPaddingLeft = $leadingIcon ? 'pl-10' : '';
    $iconPaddingRight = $trailingIcon ? 'pr-10' : '';
@endphp

<div class="form-group-enhanced">
    @if($label)
        <label for="{{ $id ?? '' }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
            {{ $label }}
        </label>
    @endif

    <div data-model="{{ $wireModel }}" class="relative rounded-md">
        @if($leadingIcon)
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 dark:text-gray-500">
            {{ $leadingIcon }}
        </div>
        @endif

        <input {{ $attributes->whereStartsWith('wire:model') }} 
            id="{{ $id ?? '' }}" 
            name="{{ $name ?? '' }}" 
            type="{{ $type ?? '' }}" 
            placeholder="{{ $placeholder }}"
            class="input-enhanced {{ $errorClasses }} {{ $iconPaddingLeft }} {{ $iconPaddingRight }}" 
            {{ $attributes->except(['wire:model', 'class']) }}
        />

        @if($trailingIcon)
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400 dark:text-gray-500">
            {{ $trailingIcon }}
        </div>
        @endif
    </div>

    @if($helpText && !($wireModel && $errors->has($wireModel)) && !$error)
        <p class="mt-1.5 text-sm text-gray-500 dark:text-gray-400">{{ $helpText }}</p>
    @endif

    @if($error)
        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $error }}</p>
    @elseif($wireModel && $errors->has($wireModel))
        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $errors->first($wireModel) }}</p>
    @endif
</div>