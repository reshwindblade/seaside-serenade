<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VerificationNotice extends Component
{
    public function resend()
    {
        $user = auth()->user();
        
        if ($user->hasVerifiedEmail()) {
            redirect('/');
        }

        $user->sendEmailVerificationNotification();

        event(new Verified($user));

        $this->dispatch('resent');
        session()->flash('resent');
    }
    
    public function render()
    {
        return view('livewire.auth.verification-notice');
    }
}