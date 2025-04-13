<!-- resources/views/components/cyberpunk/footer.blade.php -->
<footer class="mt-24 bg-black bg-opacity-70 backdrop-blur-sm border-t border-blue-500 cyber-grid">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-bold text-white mb-4 font-orbitron">CYBER<span class="text-pink-500">PUNK</span> <span class="text-xs opacity-80">RPG</span></h3>
                <p class="text-gray-400 max-w-xs">
                    Navigate the neon-drenched streets of Night City, where corporate power, gang warfare, and cutting-edge technology shape a dystopian future.
                </p>
            </div>
            
            <div class="md:mx-auto">
                <h3 class="text-lg font-semibold text-white mb-4 font-orbitron border-b border-blue-500 pb-2">Navigation</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('rules') }}" class="text-blue-400 hover:text-white transition duration-150">Rules</a>
                    </li>
                    <li>
                        <a href="{{ route('npcs') }}" class="text-blue-400 hover:text-white transition duration-150">NPCs</a>
                    </li>
                    <li>
                        <a href="{{ route('characters') }}" class="text-blue-400 hover:text-white transition duration-150">Characters</a>
                    </li>
                    <li>
                        <a href="{{ route('world') }}" class="text-blue-400 hover:text-white transition duration-150">World</a>
                    </li>
                    <li>
                        <a href="{{ route('recaps') }}" class="text-blue-400 hover:text-white transition duration-150">Recaps</a>
                    </li>
                    <li>
                        <a href="{{ route('powers') }}" class="text-blue-400 hover:text-white transition duration-150">Powers</a>
                    </li>
                </ul>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold text-white mb-4 font-orbitron border-b border-blue-500 pb-2">Connect</h3>
                <div class="flex space-x-4 mb-4">
                    <a href="#" class="text-blue-400 hover:text-white transition duration-150">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-blue-400 hover:text-white transition duration-150">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465.66.258 1.217.598 1.772 1.153.555.555.895 1.113 1.153 1.772.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.648-.012 2.975-.06 3.998-.049 1.064-.218 1.791-.465 2.427-.258.66-.598 1.217-1.153 1.772-.555.555-1.113.895-1.772 1.153-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.648 0-2.975-.012-3.998-.06-1.064-.049-1.791-.218-2.427-.465-.66-.258-1.217-.598-1.772-1.153-.555-.555-.895-1.113-1.153-1.772-.247-.636-.416-1.363-.465-2.427-.048-1.067-.06-1.407-.06-4.123v-.08c0-2.648.012-2.975.06-3.998.049-1.064.218-1.791.465-2.427.258-.66.598-1.217 1.153-1.772.555-.555 1.113-.895 1.772-1.153.636-.247 1.363-.416 2.427-.465C9.511 2.013 9.865 2 12.315 2zm0 1.802h-.08c-2.592 0-2.894.011-3.911.058-.975.045-1.504.208-1.857.344-.466.182-.8.398-1.15.748-.35.35-.566.684-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.017-.058 1.32-.058 3.91v.08c0 2.592.011 2.894.058 3.911.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.684.566 1.15.748.353.137.882.3 1.857.344 1.017.047 1.32.058 3.91.058h.08c2.592 0 2.895-.011 3.911-.058.975-.045 1.504-.207 1.857-.344.466-.182.8-.398 1.15-.748.35-.35.566-.684.748-1.15.137-.353.3-.882.344-1.857.047-1.017.058-1.32.058-3.91v-.08c0-2.592-.011-2.894-.058-3.911-.045-.975-.207-1.504-.344-1.857-.182-.466-.399-.8-.748-1.15-.35-.35-.684-.566-1.15-.748-.353-.136-.882-.3-1.857-.344-1.017-.047-1.32-.058-3.911-.058z"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-blue-400 hover:text-white transition duration-150">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.954 4.569a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723 10.08 10.08 0 01-3.124 1.19 4.92 4.92 0 00-8.384 4.482C7.691 8.094 4.066 6.13 1.64 3.161a4.82 4.82 0 00-.666 2.475c0 1.71.87 3.214 2.19 4.092a4.822 4.822 0 01-2.23-.618v.061c0 2.385 1.693 4.374 3.946 4.827-.413.112-.85.172-1.3.172-.317 0-.626-.03-.926-.085.627 1.953 2.445 3.38 4.6 3.42a9.833 9.833 0 01-6.102 2.105c-.39 0-.78-.023-1.17-.067a13.905 13.905 0 007.548 2.205c9.054 0 14-7.496 14-13.986 0-.21 0-.42-.015-.63a9.936 9.936 0 002.46-2.548z"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-blue-400 hover:text-white transition duration-150">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.164 6.839 9.49.5.09.682-.217.682-.48 0-.238-.008-.866-.013-1.7-2.782.605-3.369-1.343-3.369-1.343-.454-1.155-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.087 2.91.832.09-.645.35-1.086.636-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.268 2.75 1.026A9.578 9.578 0 0112 6.836c.85.005 1.705.114 2.504.336 1.909-1.294 2.747-1.026 2.747-1.026.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.933.359.309.678.92.678 1.854 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.137 20.162 22 16.42 22 12c0-5.523-4.477-10-10-10z"></path>
                        </svg>
                    </a>
                </div>
                <p class="text-gray-400 text-sm">
                    Join our RPG community on social media for the latest updates, character showcases, and events.
                </p>
            </div>
        </div>
        
        <div class="mt-8 pt-8 border-t border-blue-500 flex flex-col items-center">
            <p class="text-gray-400 text-sm text-center">
                &copy; {{ date('Y') }} Cyberpunk RPG. All rights reserved.
            </p>
            <div class="mt-2 text-blue-400 text-xs">
                <span class="inline-block px-2 py-1 border border-blue-500 rounded-md cyber-grid">
                    VERSION 1.0.{{ rand(1, 9) }}
                </span>
            </div>
        </div>
    </div>
</footer>