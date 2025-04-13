<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('api.docs');
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
                {{ __('API Documentation') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- API Navigation -->
            <div class="mb-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="flex overflow-x-auto">
                        @php
                            $apiEndpoints = [
                                'get-users' => ['method' => 'GET', 'route' => '/api/users', 'title' => 'Get Users List', 'description' => 'Retrieve a paginated list of all users'],
                                'get-user' => ['method' => 'GET', 'route' => '/api/users/{id}', 'title' => 'Get User Details', 'description' => 'Retrieve details for a specific user by ID'],
                                'post-user' => ['method' => 'POST', 'route' => '/api/users', 'title' => 'Create User', 'description' => 'Create a new user with the provided information'],
                                'put-user' => ['method' => 'PUT', 'route' => '/api/users/{id}', 'title' => 'Update User', 'description' => 'Update an existing user\'s information']
                            ];
                        @endphp
                        @foreach($apiEndpoints as $key => $endpoint)
                            <button 
                                class="api-tab-button 
                                    @if($loop->first) active border-blue-500 dark:border-blue-400 text-blue-600 dark:text-blue-400 @else border-transparent text-gray-500 dark:text-gray-400 @endif 
                                    whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm hover:text-gray-700 dark:hover:text-gray-300"
                                data-target="{{ $key }}"
                                data-method="{{ $endpoint['method'] }}"
                            >
                                <span class="
                                    @if($endpoint['method'] === 'GET') text-green-600 dark:text-green-400 @endif
                                    @if($endpoint['method'] === 'POST') text-blue-600 dark:text-blue-400 @endif
                                    @if($endpoint['method'] === 'PUT') text-amber-600 dark:text-amber-400 @endif
                                    font-semibold mr-2"
                                >
                                    {{ $endpoint['method'] }}
                                </span>
                                {{ $endpoint['route'] }}
                            </button>
                        @endforeach
                    </nav>
                </div>
                
                <!-- API Endpoint Details -->
                <div class="p-6">
                    @foreach($apiEndpoints as $key => $endpoint)
                        <div id="{{ $key }}" class="api-tab-content @if(!$loop->first) hidden @endif">
                            <div class="mb-6">
                                <div class="flex items-center mb-4">
                                    <span class="
                                        px-3 py-1 text-xs font-semibold text-white rounded-full 
                                        @if($endpoint['method'] === 'GET') bg-green-500 @endif
                                        @if($endpoint['method'] === 'POST') bg-blue-500 @endif
                                        @if($endpoint['method'] === 'PUT') bg-amber-500 @endif
                                    ">
                                        {{ $endpoint['method'] }}
                                    </span>
                                    <span class="ml-2 font-mono text-sm text-gray-600 dark:text-gray-300">{{ $endpoint['route'] }}</span>
                                </div>
                                
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                                    {{ $endpoint['title'] }}
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                    {{ $endpoint['description'] }}
                                </p>

                                <!-- Request Parameters -->
                                <div class="mb-6">
                                    <h4 class="text-md font-medium text-gray-800 dark:text-gray-200 mb-3">Request Parameters</h4>
                                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <thead class="bg-gray-50 dark:bg-gray-700">
                                                <tr>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Parameter</th>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Required</th>
                                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                                @if($key === 'post-user')
                                                    @include('pages.api-docs.parameters.create-user')
                                                @elseif($key === 'put-user')
                                                    @include('pages.api-docs.parameters.update-user')
                                                @else
                                                    <tr>
                                                        <td colspan="4" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                                            No parameters required
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <!-- Example Request -->
                                <div class="mb-6">
                                    <h4 class="text-md font-medium text-gray-800 dark:text-gray-200 mb-3">Example Request</h4>
                                    <div class="relative">
                                        <div class="absolute top-0 right-0 px-4 py-2">
                                            <button 
                                                class="copy-button text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300" 
                                                data-clipboard-target="#request-{{ $key }}"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                            </button>
                                        </div>
                                        <pre 
                                            id="request-{{ $key }}" 
                                            class="mt-2 p-4 bg-gray-100 dark:bg-gray-900 rounded-md overflow-x-auto text-sm font-mono"
                                        >@include("pages.api-docs.requests.{$key}")</pre>
                                    </div>
                                </div>
                                
                                <!-- Example Response -->
                                <div>
                                    <h4 class="text-md font-medium text-gray-800 dark:text-gray-200 mb-3">Example Response</h4>
                                    <div class="relative">
                                        <div class="absolute top-0 right-0 px-4 py-2">
                                            <button 
                                                class="copy-button text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300" 
                                                data-clipboard-target="#response-{{ $key }}"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                            </button>
                                        </div>
                                        <pre 
                                            id="response-{{ $key }}" 
                                            class="mt-2 p-4 bg-gray-100 dark:bg-gray-900 rounded-md overflow-x-auto text-sm font-mono"
                                        >@include("pages.api-docs.responses.{$key}")</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Authentication Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">API Authentication</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        All API requests must be authenticated using a Bearer token. To obtain a token, use the login endpoint.
                    </p>
                    
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-3">Login Endpoint</h3>
                        <div class="mb-2 mt-2">
                            <span class="px-2 py-1 text-xs font-semibold text-white bg-blue-500 rounded-full">POST</span>
                            <span class="ml-2 font-mono text-sm">/api/login</span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Authenticate with email and password to receive an API token.
                        </p>
                        
                        <div class="mb-4">
                            <h4 class="text-md font-medium text-gray-800 dark:text-gray-200 mb-3">Request Body</h4>
                            <div class="relative">
                                <div class="absolute top-0 right-0 px-4 py-2">
                                    <button 
                                        class="copy-button text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300" 
                                        data-clipboard-target="#login-request"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                        </svg>
                                    </button>
                                </div>
                                <pre 
                                    id="login-request" 
                                    class="mt-2 p-4 bg-gray-100 dark:bg-gray-900 rounded-md overflow-x-auto text-sm font-mono"
                                >{
    "email": "user@example.com",
    "password": "your-password"
}</pre>
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="text-md font-medium text-gray-800 dark:text-gray-200 mb-3">Response</h4>
                            <div class="relative">
                                <div class="absolute top-0 right-0 px-4 py-2">
                                    <button 
                                        class="copy-button text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300" 
                                        data-clipboard-target="#login-response"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                        </svg>
                                    </button>
                                </div>
                                <pre 
                                    id="login-response" 
                                    class="mt-2 p-4 bg-gray-100 dark:bg-gray-900 rounded-md overflow-x-auto text-sm font-mono"
                                >{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
    "token_type": "Bearer",
    "expires_in": 3600
}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.api-tab-button');
            const tabContents = document.querySelectorAll('.api-tab-content');
            
            // Tab Switching Functionality
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const target = this.dataset.target;
                    
                    // Hide all tab contents
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    
                    // Remove active class from all buttons
                    tabButtons.forEach(btn => {
                        btn.classList.remove('active', 'border-blue-500', 'dark:border-blue-400', 'text-blue-600', 'dark:text-blue-400');
                        btn.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400');
                    });
                    
                    // Show the selected tab content
                    document.getElementById(target).classList.remove('hidden');
                    
                    // Add active class to clicked button
                    this.classList.add('active', 'border-blue-500', 'dark:border-blue-400', 'text-blue-600', 'dark:text-blue-400');
                    this.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400');
                });
            });

            // Advanced Clipboard Functionality
            function copyToClipboard(element) {
                const text = element.textContent.trim();
                
                // Create a temporary textarea to copy text
                const tempTextArea = document.createElement('textarea');
                tempTextArea.value = text;
                document.body.appendChild(tempTextArea);
                tempTextArea.select();
                
                try {
                    document.execCommand('copy');
                    
                    // Provide visual feedback
                    const copyButton = element.previousElementSibling.querySelector('.copy-button');
                    if (copyButton) {
                        const originalHTML = copyButton.innerHTML;
                        copyButton.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        `;
                        
                        setTimeout(() => {
                            copyButton.innerHTML = originalHTML;
                        }, 2000);
                    }
                } catch (err) {
                    console.error('Failed to copy text: ', err);
                }
                
                // Remove temporary textarea
                document.body.removeChild(tempTextArea);
            }

            // Add copy functionality to all copy buttons
            document.querySelectorAll('.copy-button').forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.dataset.clipboardTarget;
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        copyToClipboard(targetElement);
                    }
                });
            });

            // Optional: Highlight code blocks
            if (window.hljs) {
                document.querySelectorAll('pre').forEach((block) => {
                    hljs.highlightBlock(block);
                });
            }
        });
    </script>

    <!-- Optional: Add syntax highlighting -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/github-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
</x-layouts.app>