<?php
// app/Http/Controllers/Auth/ForgotPasswordController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /**
     * Display the form to request a password reset link.
     */
    public function showLinkRequestForm()
    {
        return view('pages.auth.password.request');
    }
}