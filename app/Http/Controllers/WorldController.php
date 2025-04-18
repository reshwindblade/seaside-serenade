<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorldController extends Controller
{
    /**
     * Display the world setting page.
     */
    public function index()
    {
        return view('pages.world');
    }
}