<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'Magical Ocean Portal' }}</title>
        
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Dark mode script - must be before any CSS to prevent flash -->
        <script>
            if (typeof(Storage) !== "undefined") {
                if(localStorage.getItem('dark_mode') && localStorage.getItem('dark_mode') == 'true'){
                    document.documentElement.classList.add('dark');
                }
            }
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/magical-ocean.css'])
    </head>
    <body class="font-sans antialiased min-h-screen bg-gradient-to-br from-blue-50 to-white dark:from-gray-950 dark:to-blue-950 dark:text-white">
        <div class="min-h-screen flex flex-col">
            <!-- Navigation -->
            <x-ui.navigation-main />
            
            <!-- Decorative Elements -->
            <div class="ocean-waves fixed bottom-0 left-0 right-0 pointer-events-none"></div>
            <div class="ocean-waves-2 fixed bottom-0 left-0 right-0 pointer-events-none"></div>
            <div id="magical-bubbles" class="fixed inset-0 pointer-events-none"></div>
            
            <!-- Main Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>
            
            <!-- Footer -->
            <x-ui.footer-main />
        </div>
        
        <!-- Notifications -->
        <livewire:toast />
        
        <!-- Bubble animation script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const bubbleContainer = document.getElementById('magical-bubbles');
                const bubbleCount = 15;
                
                for (let i = 0; i < bubbleCount; i++) {
                    createBubble(bubbleContainer);
                }
                
                // Periodically create new bubbles
                setInterval(() => {
                    if (bubbleContainer.children.length < 30) {
                        createBubble(bubbleContainer);
                    }
                }, 3000);
            });
            
            function createBubble(container) {
                const bubble = document.createElement('div');
                bubble.classList.add('magical-bubble');
                
                // Random size between 10px and 50px
                const size = Math.floor(Math.random() * 40) + 10;
                bubble.style.width = `${size}px`;
                bubble.style.height = `${size}px`;
                
                // Random position
                const posX = Math.floor(Math.random() * 100);
                const posY = Math.floor(Math.random() * 100);
                bubble.style.left = `${posX}%`;
                bubble.style.top = `${posY}%`;
                
                // Random colors from our theme
                const colors = [
                    'rgba(26, 145, 255, 0.3)',  // ocean-primary
                    'rgba(0, 226, 195, 0.3)',   // ocean-accent
                    'rgba(255, 89, 149, 0.2)',  // magical-pink
                    'rgba(181, 74, 255, 0.2)'   // magical-purple
                ];
                bubble.style.background = colors[Math.floor(Math.random() * colors.length)];
                
                // Random animation duration
                const animDuration = Math.floor(Math.random() * 8) + 5;
                bubble.style.animationDuration = `${animDuration}s`;
                
                // Add to container
                container.appendChild(bubble);
                
                // Remove after some time
                setTimeout(() => {
                    bubble.style.opacity = '0';
                    bubble.style.transition = 'opacity 1s ease-out';
                    setTimeout(() => {
                        if (container.contains(bubble)) {
                            container.removeChild(bubble);
                        }
                    }, 1000);
                }, animDuration * 1000);
            }
        </script>
    </body>
</html>