<?php
// resources/views/pages/admin/users-list.blade.php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('admin.users-list');
middleware(['auth']);

?>

<x-layouts.admin>
    <x-slot name="header">
        User Management
    </x-slot>

    <livewire:admin.users-table />
</x-layouts.admin>