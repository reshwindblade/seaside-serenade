<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\ShortStory;
use Illuminate\Http\Request;

class ShortStoryController extends Controller
{
    /**
     * Display a listing of short stories.
     */
    public function index(Request $request)
    {
        $characterId = $request->query('character_id');
        
        $stories = ShortStory::with('character')
            ->when($characterId, function ($query) use ($characterId) {
                return $query->where('character_id', $characterId);
            })
            ->orderByDesc('story_date')
            ->paginate(10);
            
        $characters = Character::orderBy('name')->get();
        
        return view('admin.stories.index', compact('stories', 'characters', 'characterId'));
    }

    /**
     * Show the form for creating a new short story.
     */
    public function create()
    {
        $characters = Character::orderBy('name')->get();
        return view('admin.stories.create', compact('characters'));
    }

    /**
     * Store a newly created short story in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'character_id' => 'required|exists:characters,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'story_date' => 'nullable|date',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        ShortStory::create($validated);

        return redirect()->route('admin.stories.index')
            ->with('success', 'Short Story created successfully.');
    }

    /**
     * Show the form for editing the specified short story.
     */
    public function edit(ShortStory $story)
    {
        $characters = Character::orderBy('name')->get();
        return view('admin.stories.edit', compact('story', 'characters'));
    }

    /**
     * Update the specified short story in storage.
     */
    public function update(Request $request, ShortStory $story)
    {
        $validated = $request->validate([
            'character_id' => 'required|exists:characters,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'story_date' => 'nullable|date',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $story->update($validated);

        return redirect()->route('admin.stories.index')
            ->with('success', 'Short Story updated successfully.');
    }

    /**
     * Remove the specified short story from storage.
     */
    public function destroy(ShortStory $story)
    {
        $story->delete();

        return redirect()->route('admin.stories.index')
            ->with('success', 'Short Story deleted successfully.');
    }
}