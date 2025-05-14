@props([
    'primaryColor' => 'pink',
    'showTryAgain' => false
])

<div class="flex flex-col sm:flex-row items-center justify-center gap-4">
    <x-ui.button 
        href="{{ route('home') }}"
        color="{{ $primaryColor }}"
        size="lg">
        Return Home
    </x-ui.button>
    
    <x-ui.button 
        onclick="window.history.back()"
        color="secondary"
        size="lg">
        Go Back
    </x-ui.button>
    
    @if($showTryAgain)
        <x-ui.button 
            onclick="window.location.reload()"
            color="primary"
            size="lg">
            Try Again
        </x-ui.button>
    @endif
</div> 