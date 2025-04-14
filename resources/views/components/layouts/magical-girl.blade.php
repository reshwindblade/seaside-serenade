<?php
// resources/views/components/layouts/magical-girl.blade.php
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'Magical Girl Portal' }}</title>
        
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

        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/magical-girl.css'])
    </head>
    <body class="font-sans antialiased min-h-screen bg-gradient-to-br from-pink-50 to-purple-50 dark:from-purple-950 dark:to-pink-950 dark:text-white magical-girl-bg">
        <div class="min-h-screen flex flex-col">
            <!-- Header -->
            <x-magical-girl.header />
            
            <!-- Main Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>
            
            <!-- Footer -->
            <x-magical-girl.footer />
        </div>
        
        <!-- Stars animation overlay -->
        <div class="fixed top-0 left-0 w-full h-full pointer-events-none z-0 magical-stars"></div>
        
        <livewire:toast />
    </body>
</html>