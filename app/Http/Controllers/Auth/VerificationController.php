<?php
// app/Http/Controllers/Auth/VerificationController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Show the email verification notice.
     */
    public function show()
    {
        return view('pages.auth.verify');
    }
    
    /**
     * Resend the email verification notification.
     */
    public function resend(Request $request)
    {
        $user = $request->user();
        
        if ($user->hasVerifiedEmail()) {
            return redirect('/');
        }

        $user->sendEmailVerificationNotification();

        event(new Verified($user));

        return back()->with('resent', true);
    }
}