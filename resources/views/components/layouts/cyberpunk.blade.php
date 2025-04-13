<!-- resources/views/components/layouts/cyberpunk.blade.php -->
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

    <!-- Cyberpunk Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Share+Tech+Mono&display=swap" rel="stylesheet">

    <!-- Used to add dark mode right away, adding here prevents any flicker -->
    <script>
        // Force dark mode for cyberpunk theme
        document.documentElement.classList.add('dark');
        if (typeof(Storage) !== "undefined") {
            localStorage.setItem('dark_mode', 'true');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>{{ $title ?? 'Cyberpunk RPG' }}</title>

    <style>
        /* Cyberpunk theme overrides */
        :root {
            --neon-pink: #ff2a6d;
            --neon-blue: #05d9e8;
            --neon-purple: #d929f7;
            --neon-yellow: #ffd319;
            --cyber-dark: #0d0221;
            --cyber-medium: #1a1b2e;
            --cyber-light: #292b3e;
            --cyber-accent: #3d9691;
            --cyber-grid: rgba(5, 217, 232, 0.1);
        }
        
        body {
            background-image: 
                linear-gradient(0deg, rgba(26, 27, 46, 0.9), rgba(13, 2, 33, 0.95)),
                url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0h100v100H0z' fill='none'/%3E%3Cpath d='M0 0h1v1H0zm1 0h1v1H1zM0 1h1v1H0zm99-1h1v1h-1zm-1 0h1v1h-1zm1 1h1v1h-1zM0 99h1v1H0zm1 0h1v1H1zM0 98h1v1H0zm99 1h1v1h-1zm-1 0h1v1h-1zm1-1h1v1h-1z' fill='rgba(5, 217, 232, 0.15)'/%3E%3C/svg%3E"),
                linear-gradient(90deg, var(--cyber-dark), var(--cyber-medium));
            background-size: cover, 50px 50px, 100% 100%;
            font-family: 'Share Tech Mono', monospace;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Orbitron', sans-serif;
            text-transform: uppercase;
        }
        
        .cyber-glitch {
            position: relative;
        }
        
        .cyber-glitch:after {
            content: attr(data-text);
            position: absolute;
            left: 2px;
            text-shadow: -1px 0 var(--neon-pink);
            top: 0;
            color: var(--neon-blue);
            overflow: hidden;
            clip: rect(0, 900px, 0, 0);
            animation: cyber-glitch-anim 2s infinite linear alternate-reverse;
        }
        
        @keyframes cyber-glitch-anim {
            0% { clip: rect(5px, 9999px, 28px, 0); }
            10% { clip: rect(96px, 9999px, 78px, 0); }
            20% { clip: rect(92px, 9999px, 18px, 0); }
            30% { clip: rect(50px, 9999px, 36px, 0); }
            40% { clip: rect(2px, 9999px, 16px, 0); }
            50% { clip: rect(31px, 9999px, 16px, 0); }
            60% { clip: rect(89px, 9999px, 16px, 0); }
            70% { clip: rect(2px, 9999px, 38px, 0); }
            80% { clip: rect(14px, 9999px, 8px, 0); }
            90% { clip: rect(77px, 9999px, 73px, 0); }
            100% { clip: rect(24px, 9999px, 86px, 0); }
        }
        
        .cyber-border {
            position: relative;
            border: 1px solid var(--neon-blue);
            box-shadow: 0 0 10px rgba(5, 217, 232, 0.5), inset 0 0 10px rgba(5, 217, 232, 0.2);
        }
        
        .cyber-border:before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            z-index: -1;
            background: linear-gradient(45deg, 
                var(--neon-blue), 
                transparent, 
                transparent, 
                var(--neon-pink));
            animation: cyber-border-rotate 3s linear infinite;
        }
        
        @keyframes cyber-border-rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .cyber-button {
            position: relative;
            background: var(--cyber-medium);
            color: var(--neon-blue);
            border: 1px solid var(--neon-blue);
            padding: 0.75rem 1.5rem;
            font-family: 'Orbitron', sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.2s ease;
            box-shadow: 0 0 10px rgba(5, 217, 232, 0.25), inset 0 0 5px rgba(5, 217, 232, 0.1);
            overflow: hidden;
        }
        
        .cyber-button:hover {
            background: var(--cyber-light);
            color: white;
            box-shadow: 0 0 15px rgba(5, 217, 232, 0.5), inset 0 0 10px rgba(5, 217, 232, 0.2);
        }
        
        .cyber-button:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            transition: left 0.7s ease;
        }
        
        .cyber-button:hover:before {
            left: 100%;
        }
        
        .cyber-card {
            background: var(--cyber-medium);
            border: 1px solid var(--neon-blue);
            border-radius: 0.25rem;
            box-shadow: 0 0 15px rgba(5, 217, 232, 0.3), inset 0 0 5px rgba(5, 217, 232, 0.1);
            transition: all 0.2s ease;
            overflow: hidden;
        }
        
        .cyber-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(5, 217, 232, 0.5), inset 0 0 10px rgba(5, 217, 232, 0.2);
        }
        
        .cyber-grid {
            background-image: linear-gradient(var(--cyber-grid) 1px, transparent 1px),
                             linear-gradient(90deg, var(--cyber-grid) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        
        .neon-text-pink {
            color: var(--neon-pink);
            text-shadow: 0 0 5px rgba(255, 42, 109, 0.5), 0 0 10px rgba(255, 42, 109, 0.3);
        }
        
        .neon-text-blue {
            color: var(--neon-blue);
            text-shadow: 0 0 5px rgba(5, 217, 232, 0.5), 0 0 10px rgba(5, 217, 232, 0.3);
        }
        
        .neon-text-purple {
            color: var(--neon-purple);
            text-shadow: 0 0 5px rgba(217, 41, 247, 0.5), 0 0 10px rgba(217, 41, 247, 0.3);
        }
        
        .neon-text-yellow {
            color: var(--neon-yellow);
            text-shadow: 0 0 5px rgba(255, 211, 25, 0.5), 0 0 10px rgba(255, 211, 25, 0.3);
        }
    </style>
</head>
<body class="min-h-screen antialiased dark:from-gray-950 dark:to-gray-900">
    <x-cyberpunk.header />
    
    <main class="pt-20">
        {{ $slot }}
    </main>
    
    <x-cyberpunk.footer />
    
    <livewire:toast />
</body>
</html>