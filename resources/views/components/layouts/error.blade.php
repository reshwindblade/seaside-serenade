@props([
    'title',
    'code',
    'message',
    'description',
    'color' => 'pink',
    'showAdminDetails' => false,
    'exception' => null
])

<div class="min-h-screen flex flex-col items-center justify-center px-4">
    <div class="text-center">
        <div class="mb-8">
            <h1 class="text-6xl font-bold text-{{ $color }}-600 mb-2">{{ $code }}</h1>
            <p class="text-3xl font-semibold text-gray-700 dark:text-gray-300">{{ $message }}</p>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">{{ $description }}</p>
        </div>

        <div class="mb-8">
            <div class="w-full max-w-md mx-auto">
                {{ $illustration }}
            </div>
        </div>
        
        @if($showAdminDetails && $exception && auth()->check() && auth()->user()->is_admin)
            <div class="mb-8 max-w-2xl mx-auto p-4 bg-gray-100 dark:bg-gray-800 rounded-lg text-left">
                <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Error Details (Admin Only)</h3>
                <p class="text-gray-700 dark:text-gray-300 mb-2">Error message: {{ $exception->getMessage() }}</p>
                <p class="text-gray-700 dark:text-gray-300 mb-2">File: {{ $exception->getFile() }}</p>
                <p class="text-gray-700 dark:text-gray-300">Line: {{ $exception->getLine() }}</p>
                
                <div class="mt-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Stack trace:</p>
                    <pre class="mt-2 p-2 bg-gray-200 dark:bg-gray-700 rounded text-xs text-gray-800 dark:text-gray-200 overflow-x-auto">{{ $exception->getTraceAsString() }}</pre>
                </div>
            </div>
        @endif
        
        <div>
            <p class="mb-6 text-gray-600 dark:text-gray-400">{{ $helpText }}</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                {{ $actions }}
            </div>
        </div>
    </div>
</div> 