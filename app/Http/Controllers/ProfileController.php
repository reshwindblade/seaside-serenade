<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        return view('pages.profile.edit');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|min:3|email|max:255|unique:users,email,' . $user->id . ',id',
        ]);

        // If the user hasn't changed their name or email, don't update and show error
        if ($user->name == $request->name && $user->email == $request->email) {
            return back()->with('info', 'Nothing to update.');
        }

        $user->fill($validated)->save();

        return back()->with('success', 'Successfully updated profile.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'delete_confirm_password' => 'required|current_password',
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}