<x-layouts.main>
    <div class="flex flex-col items-stretch justify-center w-screen min-h-screen py-10 sm:items-center">

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <x-ui.link href="{{ route('home') }}">
                <x-ui.logo class="w-auto h-10 mx-auto text-gray-700 fill-current dark:text-gray-100" />
            </x-ui.link>

            <h2 class="mt-6 text-2xl font-extrabold leading-9 text-center text-gray-700 dark:text-gray-200">
                Verify your email address
            </h2>

            <div class="mt-2 text-sm leading-5 text-center text-gray-600 dark:text-gray-400 space-x-0.5">
                <span>Or</span>
                <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-gray-500 underline cursor-pointer dark:text-gray-400 dark:hover:text-gray-300 hover:text-gray-800">
                    sign out
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-10 py-0 sm:py-8 sm:shadow-sm sm:bg-white dark:sm:bg-gray-950/50 dark:border-gray-200/10 sm:border sm:rounded-lg border-gray-200/60">
                <livewire:auth.verification-notice />
            </div>
        </div>
    </div>
</x-layouts.main>