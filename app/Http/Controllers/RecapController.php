<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecapController extends Controller
{
    /**
     * Display the adventure recaps page.
     */
    public function index()
    {
        return view('pages.recaps');
    }
}