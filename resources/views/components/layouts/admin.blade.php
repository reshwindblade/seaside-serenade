<?php
// resources/views/components/layouts/admin.blade.php
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'Admin Panel - Magical Girl Portal' }}</title>
        
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Used to add dark mode right away, adding here prevents any flicker -->
        <script>
            if (typeof(Storage) !== "undefined") {
                if(localStorage.getItem('dark_mode') && localStorage.getItem('dark_mode') == 'true'){
                    document.documentElement.classList.add('dark');
                }
            }
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/magical-girl.css', 'resources/css/admin.css'])
    </head>
    <body class="font-sans antialiased min-h-screen bg-gradient-to-br from-gray-50 to-pink-50 dark:from-gray-950 dark:to-purple-950 dark:text-white">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <x-admin.sidebar />
            
            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <x-admin.header />
                
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 dark:bg-gray-900/50 p-4 md:p-6">
                    <!-- Page Heading -->
                    @if (isset($header))
                        <div class="mx-auto max-w-7xl">
                            <div class="pb-6 flex items-center justify-between">
                                {{ $header }}
                            </div>
                        </div>
                    @endif
                    
                    <!-- Page Content -->
                    <div class="mx-auto max-w-7xl">
                        {{ $slot }}
                    </div>
                </main>
                
                <!-- Footer -->
                <x-admin.footer />
            </div>
        </div>
        
        <livewire:toast />
    </body>
</html>