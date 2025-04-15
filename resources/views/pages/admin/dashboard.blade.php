<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('admin.dashboard');
middleware(['auth']);

?>

<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Admin Dashboard') }}
            </h2>
            @if(env('APP_ENV') === 'local')
                <div class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800 dark:bg-amber-800 dark:text-amber-100">
                    {{ env('USE_DUMMY_DATA', false) ? 'Using Dummy Data' : 'Using Real Data' }}
                </div>
            @endif
        </div>
    </x-slot>

    <livewire:admin.dashboard-stats />
</x-layouts.app>