<?php
// app/Http/Controllers/Auth/ConfirmPasswordController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ConfirmPasswordController extends Controller
{
    /**
     * Show the confirm password view.
     */
    public function showConfirmForm()
    {
        return view('pages.auth.password.confirm');
    }
    
    /**
     * Confirm the user's password.
     */
    public function confirm(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|current_password',
        ]);

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended('/');
    }
}