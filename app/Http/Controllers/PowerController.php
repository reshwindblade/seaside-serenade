<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PowerController extends Controller
{
    /**
     * Display the powers and abilities page.
     */
    public function index()
    {
        return view('pages.powers');
    }
}