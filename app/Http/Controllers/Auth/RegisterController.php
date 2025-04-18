<?php
// app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show the application registration form.
     */
    public function showRegistrationForm()
    {
        if (config('app.disable_registration')) {
            abort(403, 'New account registration is currently disabled.');
        }
        
        return view('pages.auth.register');
    }

    /**
     * Handle a registration request for the application.
     */
    public function register(Request $request)
    {
        if (config('app.disable_registration')) {
            abort(403, 'New account registration is currently disabled.');
        }
        
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:10|max:15',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        Auth::login($user, true);

        return redirect()->route('registration.thankyou');
    }
    
    /**
     * Show the registration thank you page.
     */
    public function thankYou()
    {
        return view('pages.registration.thankyou');
    }
}