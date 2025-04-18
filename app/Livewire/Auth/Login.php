<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Login as LoginEvent;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required|email')]
    public $email = '';

    #[Validate('required')]
    public $password = '';

    public $remember = false;

    public function authenticate()
    {
        // Check if new account creation is disabled
        if (config('app.disable_registration') && !User::where('email', $this->email)->exists()) {
            $this->addError('email', 'New account creation is currently disabled.');
            return;
        }

        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));
            return;
        }

        event(new LoginEvent(auth()->guard('web'), User::where('email', $this->email)->first(), $this->remember));

        return redirect()->intended('/');
    }
    
    public function render()
    {
        return view('livewire.auth.login');
    }
}