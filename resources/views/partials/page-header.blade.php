@props([
    'title',
    'description' => null
])

<div class="mb-8 text-center">
    <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 dark:from-blue-400 dark:via-indigo-400 dark:to-purple-400">
        {{ $title }}
    </h1>
    
    @if($description)
    <p class="mt-3 text-blue-800/70 dark:text-blue-200/70">
        {{ $description }}
    </p>
    @endif
</div>
