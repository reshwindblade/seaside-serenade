<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Npc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NpcController extends Controller
{
    /**
     * Display a listing of the NPCs.
     */
    public function index(Request $request)
    {
        $npcs = Npc::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($request->status !== null, function ($query) use ($request) {
                $query->where('is_active', $request->status);
            })
            ->orderBy($request->sort_field ?? 'created_at', $request->sort_direction ?? 'desc')
            ->paginate($request->per_page ?? 10);
        
        return response()->json(['npcs' => $npcs]);
    }

    /**
     * Store a newly created NPC.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'order' => 'integer|nullable',
        ]);
        
        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);
        
        // Ensure slug is unique
        $count = 0;
        $originalSlug = $validated['slug'];
        while (Npc::where('slug', $validated['slug'])->exists()) {
            $count++;
            $validated['slug'] = $originalSlug . '-' . $count;
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('npcs', 'public');
            $validated['image'] = Storage::url($path);
        }
        
        $npc = Npc::create($validated);
        
        return response()->json([
            'message' => 'NPC created successfully',
            'npc' => $npc
        ], 201);
    }

    /**
     * Display the specified NPC.
     */
    public function show(Npc $npc)
    {
        return response()->json(['npc' => $npc]);
    }

    /**
     * Update the specified NPC.
     */
    public function update(Request $request, Npc $npc)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'sometimes|boolean',
            'order' => 'sometimes|integer|nullable',
        ]);
        
        // Update slug if name changed
        if (isset($validated['name']) && $validated['name'] !== $npc->name) {
            $validated['slug'] = Str::slug($validated['name']);
            
            // Ensure slug is unique
            $count = 0;
            $originalSlug = $validated['slug'];
            while (Npc::where('slug', $validated['slug'])->where('id', '!=', $npc->id)->exists()) {
                $count++;
                $validated['slug'] = $originalSlug . '-' . $count;
            }
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($npc->image) {
                $oldPath = str_replace('/storage/', '', $npc->image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            
            $path = $request->file('image')->store('npcs', 'public');
            $validated['image'] = Storage::url($path);
        }
        
        $npc->update($validated);
        
        return response()->json([
            'message' => 'NPC updated successfully',
            'npc' => $npc
        ]);
    }

    /**
     * Remove the specified NPC.
     */
    public function destroy(Npc $npc)
    {
        // Delete image if exists
        if ($npc->image) {
            $path = str_replace('/storage/', '', $npc->image);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        
        $npc->delete();
        
        return response()->json([
            'message' => 'NPC deleted successfully'
        ]);
    }
}