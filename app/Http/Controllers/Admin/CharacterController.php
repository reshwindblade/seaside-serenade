<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CharacterController extends Controller
{
    /**
     * Display a listing of the Characters.
     */
    public function index(Request $request)
    {
        $characters = Character::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('title', 'like', "%{$search}%")
                      ->orWhere('player_name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($request->status !== null, function ($query) use ($request) {
                $query->where('is_active', $request->status);
            })
            ->orderBy($request->sort_field ?? 'created_at', $request->sort_direction ?? 'desc')
            ->paginate($request->per_page ?? 10);
        
        return response()->json(['characters' => $characters]);
    }

    /**
     * Store a newly created Character.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'player_name' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer|nullable',
        ]);
        
        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);
        
        // Ensure slug is unique
        $count = 0;
        $originalSlug = $validated['slug'];
        while (Character::where('slug', $validated['slug'])->exists()) {
            $count++;
            $validated['slug'] = $originalSlug . '-' . $count;
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('characters', 'public');
            $validated['image'] = Storage::url($path);
        }
        
        $character = Character::create($validated);
        
        return response()->json([
            'message' => 'Character created successfully',
            'character' => $character
        ], 201);
    }

    /**
     * Display the specified Character.
     */
    public function show(Character $character)
    {
        return response()->json(['character' => $character]);
    }

    /**
     * Update the specified Character.
     */
    public function update(Request $request, Character $character)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'nullable|image|max:2048',
            'player_name' => 'nullable|string|max:255',
            'is_active' => 'sometimes|boolean',
            'order' => 'sometimes|integer|nullable',
        ]);
        
        // Update slug if name changed
        if (isset($validated['name']) && $validated['name'] !== $character->name) {
            $validated['slug'] = Str::slug($validated['name']);
            
            // Ensure slug is unique
            $count = 0;
            $originalSlug = $validated['slug'];
            while (Character::where('slug', $validated['slug'])->where('id', '!=', $character->id)->exists()) {
                $count++;
                $validated['slug'] = $originalSlug . '-' . $count;
            }
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($character->image) {
                $oldPath = str_replace('/storage/', '', $character->image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            
            $path = $request->file('image')->store('characters', 'public');
            $validated['image'] = Storage::url($path);
        }
        
        $character->update($validated);
        
        return response()->json([
            'message' => 'Character updated successfully',
            'character' => $character
        ]);
    }

    /**
     * Remove the specified Character.
     */
    public function destroy(Character $character)
    {
        // Delete image if exists
        if ($character->image) {
            $path = str_replace('/storage/', '', $character->image);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        
        $character->delete();
        
        return response()->json([
            'message' => 'Character deleted successfully'
        ]);
    }
}