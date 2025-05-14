@props([
    'type' => 'info',
    'dismissible' => false
])

@php
    $classes = [
        'success' => 'bg-green-100 dark:bg-green-900/30 border-green-300 dark:border-green-800 text-green-700 dark:text-green-300',
        'error' => 'bg-red-100 dark:bg-red-900/30 border-red-300 dark:border-red-800 text-red-700 dark:text-red-400',
        'warning' => 'bg-yellow-100 dark:bg-yellow-900/30 border-yellow-300 dark:border-yellow-800 text-yellow-700 dark:text-yellow-400',
        'info' => 'bg-blue-100 dark:bg-blue-900/30 border-blue-300 dark:border-blue-800 text-blue-700 dark:text-blue-300',
    ];
@endphp

@if(session('success'))
<div class="mb-6 p-4 {{ $classes['success'] }} rounded-lg border">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-6 p-4 {{ $classes['error'] }} rounded-lg border">
    {{ session('error') }}
</div>
@endif

@if(session('warning'))
<div class="mb-6 p-4 {{ $classes['warning'] }} rounded-lg border">
    {{ session('warning') }}
</div>
@endif

@if(session('info'))
<div class="mb-6 p-4 {{ $classes['info'] }} rounded-lg border">
    {{ session('info') }}
</div>
@endif

@if(session('status'))
<div class="mb-6 p-4 {{ $classes['success'] }} rounded-lg border">
    {{ session('status') }}
</div>
@endif
