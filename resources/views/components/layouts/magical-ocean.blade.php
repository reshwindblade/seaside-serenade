{{-- resources/views/components/layouts/magical-ocean.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Dark mode toggle script -->
        <script>
            if (typeof(Storage) !== "undefined") {
                if(localStorage.getItem('dark_mode') && localStorage.getItem('dark_mode') == 'true'){
                    document.documentElement.classList.add('dark');
                }
            }
        </script>

        <!-- Alpine.js animation plugin -->
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <title>{{ $title ?? 'Magical Ocean Portal' }}</title>
        
        {{-- Inline styles for our magical ocean theme --}}
        <style>
            :root {
                --ocean-primary: #1a91ff;
                --ocean-secondary: #5643fd;
                --ocean-accent: #00e2c3;
                --ocean-deep: #0a2463;
                --ocean-light: #b3e0ff;
                --magical-pink: #ff5995;
                --magical-purple: #b54aff;
                --magical-gradient: linear-gradient(135deg, var(--ocean-primary), var(--magical-purple));
            }
            
            body {
                font-family: 'Quicksand', 'Poppins', sans-serif;
                overflow-x: hidden;
            }
            
            .magical-gradient-bg {
                background: linear-gradient(135deg, #1a91ff, #5643fd, #00e2c3, #ff5995);
                background-size: 400% 400%;
                animation: gradientBG 15s ease infinite;
            }
            
            .magical-card {
                backdrop-filter: blur(10px);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.18);
                background: rgba(255, 255, 255, 0.25);
            }
            
            .magical-button {
                position: relative;
                overflow: hidden;
                transition: all 0.3s ease;
                background: var(--magical-gradient);
                background-size: 200% 200%;
                animation: subtleShift 5s ease infinite;
            }
            
            .magical-button::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 200%;
                height: 100%;
                background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0) 100%);
                transform: translateX(-100%);
            }
            
            .magical-button:hover::after {
                transform: translateX(100%);
                transition: all 1s ease;
            }
            
            .ocean-waves {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 15vh;
                background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%231a91ff' fill-opacity='0.1' d='M0,224L48,224C96,224,192,224,288,208C384,192,480,160,576,165.3C672,171,768,213,864,208C960,203,1056,149,1152,133.3C1248,117,1344,139,1392,149.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E") no-repeat bottom;
                background-size: 200% 100%;
                opacity: 0.6;
                z-index: -1;
                animation: waveMotion 15s linear infinite;
            }
            
            .ocean-waves-2 {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 20vh;
                background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%2300e2c3' fill-opacity='0.08' d='M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,224C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E") no-repeat bottom;
                background-size: 200% 100%;
                opacity: 0.7;
                z-index: -2;
                animation: waveMotion 12s linear infinite reverse;
            }
            
            .floating {
                animation: floating 3s ease-in-out infinite;
            }
            
            .shimmer {
                position: relative;
                overflow: hidden;
            }
            
            .shimmer::after {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: linear-gradient(
                    to bottom right, 
                    rgba(255, 255, 255, 0) 0%,
                    rgba(255, 255, 255, 0) 40%,
                    rgba(255, 255, 255, 0.6) 50%,
                    rgba(255, 255, 255, 0) 60%,
                    rgba(255, 255, 255, 0) 100%
                );
                transform: rotate(30deg);
                animation: shimmer 3s linear infinite;
            }
            
            .magical-bubble {
                position: absolute;
                border-radius: 50%;
                background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.1));
                animation: float 5s ease-in-out infinite;
                opacity: 0.7;
            }
            
            @keyframes gradientBG {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            
            @keyframes subtleShift {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            
            @keyframes waveMotion {
                0% { background-position-x: 0%; }
                100% { background-position-x: 100%; }
            }
            
            @keyframes floating {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
                100% { transform: translateY(0px); }
            }
            
            @keyframes shimmer {
                0% { transform: rotate(30deg) translateX(-100%); }
                100% { transform: rotate(30deg) translateX(100%); }
            }
            
            @keyframes float {
                0% { transform: translateY(0px) translateX(0px); }
                25% { transform: translateY(-10px) translateX(5px); }
                50% { transform: translateY(0px) translateX(10px); }
                75% { transform: translateY(10px) translateX(5px); }
                100% { transform: translateY(0px) translateX(0px); }
            }
            
            .dark .magical-card {
                background: rgba(30, 41, 59, 0.7);
                border: 1px solid rgba(255, 255, 255, 0.08);
            }
        </style>
    </head>
    <body class="min-h-screen antialiased bg-gradient-to-b from-blue-50 to-white dark:from-gray-950 dark:to-gray-900 dark:text-gray-100">
        {{-- Decorative elements for the magic ocean theme --}}
        <div class="ocean-waves"></div>
        <div class="ocean-waves-2"></div>
        
        {{-- Random floating bubbles generated with JavaScript --}}
        <div id="magical-bubbles" class="fixed inset-0 pointer-events-none z-0"></div>
        
        {{-- Main content --}}
        {{ $slot }}
        
        {{-- Toast for notifications --}}
        <livewire:toast />
        
        {{-- Bubble generation script --}}
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