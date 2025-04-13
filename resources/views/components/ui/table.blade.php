@props([
    'headers' => [],
    'striped' => false,
    'hover' => true
])

@php
    $stripeClass = $striped ? 'odd:bg-white even:bg-gray-50 dark:odd:bg-gray-800 dark:even:bg-gray-800/50' : 'bg-white dark:bg-gray-800';
    $hoverClass = $hover ? 'hover:bg-gray-50 dark:hover:bg-gray-700/50' : '';
@endphp

<div class="overflow-x-auto">
    <table {{ $attributes->merge(['class' => 'table-enhanced']) }}>
        @if(count($headers))
        <thead>
            <tr>
                @foreach($headers as $header)
                <th scope="col" @if(isset($header['width'])) style="width: {{ $header['width'] }}" @endif>
                    @if(isset($header['sortable']) && $header['sortable'])
                    <div class="flex items-center cursor-pointer">
                        {{ $header['label'] }}
                        @if(isset($header['sorted']) && $header['sorted'])
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                @if(isset($header['direction']) && $header['direction'] === 'asc')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                @endif
                            </svg>
                        @endif
                    </div>
                    @else
                        {{ $header['label'] }}
                    @endif
                </th>
                @endforeach
            </tr>
        </thead>
        @endif
        <tbody class="{{ $stripeClass }}">
            {{ $slot }}
        </tbody>
    </table>
</div>