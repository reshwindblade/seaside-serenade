<?php
// resources/views/components/magical-girl/footer.blade.php
?>
<footer class="bg-white/80 dark:bg-purple-900/50 backdrop-blur-sm border-t border-pink-100 dark:border-purple-800/30 mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Logo & description -->
                <div>
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-pink-500 mr-2" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 1L15.5 8.5L23 9.5L17.5 15.5L19 23L12 19.5L5 23L6.5 15.5L1 9.5L8.5 8.5L12 1Z" />
                        </svg>
                        <span class="font-bold text-lg text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-purple-600 dark:from-pink-300 dark:to-purple-300">
                            Magical Girl Portal
                        </span>
                    </div>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                        A magical gathering place for players and game masters alike.
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200 tracking-wider uppercase">
                        Quick Links
                    </h3>
                    <ul class="mt-4 space-y-2">
                        <li>
                            <a href="{{ route('rules') }}" class="text-pink-600 dark:text-pink-300 hover:text-purple-600 dark:hover:text-purple-300 transition-colors">
                                Rules / How to Play
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('characters') }}" class="text-pink-600 dark:text-pink-300 hover:text-purple-600 dark:hover:text-purple-300 transition-colors">
                                Player Characters
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('world') }}" class="text-pink-600 dark:text-pink-300 hover:text-purple-600 dark:hover:text-purple-300 transition-colors">
                                World Setting
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('powers') }}" class="text-pink-600 dark:text-pink-300 hover:text-purple-600 dark:hover:text-purple-300 transition-colors">
                                Powers & Abilities
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Account -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200 tracking-wider uppercase">
                        Account
                    </h3>
                    <ul class="mt-4 space-y-2">
                        @auth
                            <li>
                                <a href="{{ route('profile.edit') }}" class="text-pink-600 dark:text-pink-300 hover:text-purple-600 dark:hover:text-purple-300 transition-colors">
                                    Your Profile
                                </a>
                            </li>
                            @if(Auth::user()->is_admin)
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" class="text-pink-600 dark:text-pink-300 hover:text-purple-600 dark:hover:text-purple-300 transition-colors">
                                        Admin Dashboard
                                    </a>
                                </li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-pink-600 dark:text-pink-300 hover:text-purple-600 dark:hover:text-purple-300 transition-colors bg-transparent p-0 border-0">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="text-pink-600 dark:text-pink-300 hover:text-purple-600 dark:hover:text-purple-300 transition-colors">
                                    Login
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}" class="text-pink-600 dark:text-pink-300 hover:text-purple-600 dark:hover:text-purple-300 transition-colors">
                                    Register
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
            
            <div class="mt-8 border-t border-pink-100 dark:border-purple-800/30 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    &copy; {{ date('Y') }} Magical Girl Portal. All rights reserved.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <!-- Social links -->
                    <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-pink-600 dark:hover:text-pink-300 transition-colors">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-pink-600 dark:hover:text-pink-300 transition-colors">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>