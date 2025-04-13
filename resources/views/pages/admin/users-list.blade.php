<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('admin.users-list');
middleware(['auth']);

?>

@volt
<div>
    <?php
    new class extends Component 
    {
        public function render(): mixed
        {
            return <<<'HTML'
                <div></div>
            HTML;
        }
    };
    ?>
</div>
@endvolt

<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Registered Users') }}
            </h2>
        </div>
    </x-slot>

    <livewire:admin.users-table />
</x-layouts.app>