<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Talent;
use Illuminate\Http\Request;

class TalentController extends Controller
{
    /**
     * Display a listing of talents.
     */
    public function index(Request $request)
    {
        $category = $request->query('category');
        $categories = Talent::categories();
        
        $talents = Talent::when($category, function ($query) use ($category) {
                return $query->where('category', $category);
            })
            ->orderBy('category')
            ->orderBy('name')
            ->paginate(10);
            
        return view('admin.talents.index', compact('talents', 'categories', 'category'));
    }

    /**
     * Show the form for creating a new talent.
     */
    public function create()
    {
        $categories = Talent::categories();
        return view('admin.talents.create', compact('categories'));
    }

    /**
     * Store a newly created talent in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'description' => 'nullable|string',
            'power_rating' => 'required|integer',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        Talent::create($validated);

        return redirect()->route('admin.talents.index')
            ->with('success', 'Talent created successfully.');
    }

    /**
     * Show the form for editing the specified talent.
     */
    public function edit(Talent $talent)
    {
        $categories = Talent::categories();
        return view('admin.talents.edit', compact('talent', 'categories'));
    }

    /**
     * Update the specified talent in storage.
     */
    public function update(Request $request, Talent $talent)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'description' => 'nullable|string',
            'power_rating' => 'required|integer',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $talent->update($validated);

        return redirect()->route('admin.talents.index')
            ->with('success', 'Talent updated successfully.');
    }

    /**
     * Remove the specified talent from storage.
     */
    public function destroy(Talent $talent)
    {
        $talent->delete();

        return redirect()->route('admin.talents.index')
            ->with('success', 'Talent deleted successfully.');
    }
}