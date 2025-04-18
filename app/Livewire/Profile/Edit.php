<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;

class Edit extends Component
{
    public $user;

    public $name = '';
    public $email = '';
    public $current_password = '';

    #[Validate('required|confirmed|min:6')]
    public $new_password = '';
    public $new_password_confirmation = '';
    public $delete_confirm_password = '';

    public function mount()
    {
        $this->user = auth()->user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function updateProfile()
    {
        $validated = $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|min:3|email|max:255|unique:users,email,' . $this->user->id . ',id',
        ]);

        // if the user hasn't changed their name or email and we also want to make, don't update and show error
        if ($this->user->name == $this->name && $this->user->email == $this->email) {
            $this->dispatch('toast', message: 'Nothing to update.', data: ['position' => 'top-right', 'type' => 'info']);
            return;
        }

        $this->user->fill(['email' => $this->email, 'name' => $this->name])->save();

        $this->dispatch('toast', message: 'Successfully updated profile.', data: ['position' => 'top-right', 'type' => 'success']);
    }

    public function updatePassword()
    {
        $validated = $this->validate();

        if (!Hash::check($this->current_password, $this->user->password)) {
            $this->dispatch('toast', message: 'Current Password Incorrect', data: ['position' => 'top-right', 'type' => 'danger']);
            return;
        }

        $this->dispatch('toast', message: 'Successfully updated password.', data: ['position' => 'top-right', 'type' => 'success']);
        $this->user->fill(['password' => Hash::make($this->new_password), 'remember_token' => Str::random(60)])->save();

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    }

    public function destroy()
    {
        if (!Hash::check($this->delete_confirm_password, $this->user->password)) {
            $this->dispatch('toast', message: 'The Password you entered is incorrect', data: ['position' => 'top-right', 'type' => 'danger']);
            $this->reset(['delete_confirm_password']);
            return;
        }

        $user = auth()->user();

        Auth::logout();

        $user->delete();

        request()
            ->session()
            ->invalidate();
        request()
            ->session()
            ->regenerateToken();

        return redirect()->to('/');
    }

    public function render()
    {
        return view('livewire.profile.edit');
    }
}