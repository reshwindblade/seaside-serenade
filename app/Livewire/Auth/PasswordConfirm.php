<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Validate;

class PasswordConfirm extends Component
{
    #[Validate('required|current_password')]
    public $password = '';

    public function confirm()
    {
        $this->validate();

        session()->put('auth.password_confirmed_at', time());

        return redirect()->intended('/');
    }
    
    public function render()
    {
        return view('livewire.auth.password-confirm');
    }
}