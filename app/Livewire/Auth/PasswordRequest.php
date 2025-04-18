<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class PasswordRequest extends Component
{
    public $email = '';

    public function sendResetLink()
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            ['email' => $this->email]
        );

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('status', __($status));
            $this->reset('email');
        } else {
            $this->addError('email', __($status));
        }
    }

    public function render()
    {
        return view('livewire.auth.password-request');
    }
}