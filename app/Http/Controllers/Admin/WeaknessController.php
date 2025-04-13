<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Weakness;
use Illuminate\Http\Request;

class WeaknessController extends Controller
{
    /**
     * Display a listing of weaknesses.
     */
    public function index()
    {
        $weaknesses = Weakness::orderBy('name')->paginate(10);
        return view('admin.weaknesses.index', compact('weaknesses'));
    }

    /**
     * Show the form for creating a new weakness.
     */
    public function create()
    {
        return view('admin.weaknesses.create');
    }

    /**
     * Store a newly created weakness in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'power_rating' => 'required|integer', // Typically negative
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        Weakness::create($validated);

        return redirect()->route('admin.weaknesses.index')
            ->with('success', 'Weakness created successfully.');
    }

    /**
     * Show the form for editing the specified weakness.
     */
    public function edit(Weakness $weakness)
    {
        return view('admin.weaknesses.edit', compact('weakness'));
    }

    /**
     * Update the specified weakness in storage.
     */
    public function update(Request $request, Weakness $weakness)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'power_rating' => 'required|integer', // Typically negative
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $weakness->update($validated);

        return redirect()->route('admin.weaknesses.index')
            ->with('success', 'Weakness updated successfully.');
    }

    /**
     * Remove the specified weakness from storage.
     */
    public function destroy(Weakness $weakness)
    {
        $weakness->delete();

        return redirect()->route('admin.weaknesses.index')
            ->with('success', 'Weakness deleted successfully.');
    }
}