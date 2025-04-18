<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    /**
     * Display a listing of the characters.
     */
    public function index()
    {
        return view('pages.characters');
    }

    /**
     * Display the specified character.
     */
    public function show(Character $character)
    {
        return view('pages.characters.show', compact('character'));
    }
}