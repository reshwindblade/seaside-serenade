{{-- resources/views/livewire/auth/verification-notice.blade.php --}}
<div>
    @if (session('resent'))
    <div class="flex items-center px-4 py-3 mb-6 text-sm text-white bg-green-500 rounded shadow" role="alert">
        <svg class="w-4 h-4 mr-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>

        <p>A fresh verification link has been sent to your email address.</p>
    </div>
    @endif

    <div class="text-sm leading-6 text-gray-700 dark:text-gray-400">
        <p>Before proceeding, please check your email for a verification link. If you did not receive the
            email, <a wire:click="resend" class="text-gray-700 underline transition duration-150 ease-in-out cursor-pointer dark:text-gray-300 hover:text-gray-600 focus:outline-none focus:underline">click
                here to request another</a>.</p>
    </div>
</div>