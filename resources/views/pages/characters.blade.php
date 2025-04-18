<x-layouts.magical-ocean>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Characters') }}
            </h2>
        </div>
    </x-slot>

    @livewire('characters-list')
</x-layouts.magical-ocean>