<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Display the users list.
     */
    public function usersList()
    {
        return view('admin.users-list');
    }

    /**
     * Display the system settings.
     */
    public function settings()
    {
        return view('admin.settings');
    }
}