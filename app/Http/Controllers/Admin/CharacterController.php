<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\CombatSuit;
use App\Models\SignatureAbility;
use App\Models\Talent;
use App\Models\Weakness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CharacterController extends Controller
{
    /**
     * Display a listing of characters.
     */
    public function index()
    {
        $characters = Character::with(['combatSuit', 'signatureAbility'])
            ->orderBy('name')
            ->paginate(10);
            
        return view('admin.characters.index', compact('characters'));
    }

    /**
     * Show the form for creating a new character.
     */
    public function create()
    {
        $combatSuits = CombatSuit::orderBy('name')->get();
        $signatureAbilities = SignatureAbility::orderBy('name')->get();
        $talents = Talent::orderBy('category')->orderBy('name')->get();
        $weaknesses = Weakness::orderBy('name')->get();
        
        return view('admin.characters.create', compact(
            'combatSuits', 
            'signatureAbilities', 
            'talents', 
            'weaknesses'
        ));
    }

    /**
     * Store a newly created character in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'player_name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'required|string',
            'combat_suit_id' => 'nullable|exists:combat_suits,id',
            'signature_ability_id' => 'nullable|exists:signature_abilities,id',
            'talents' => 'nullable|array',
            'talents.*' => 'exists:talents,id',
            'weaknesses' => 'nullable|array',
            'weaknesses.*' => 'exists:weaknesses,id',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('characters', 'public');
        }

        // Create character
        $character = Character::create([
            'name' => $validated['name'],
            'player_name' => $validated['player_name'],
            'image' => $validated['image'] ?? null,
            'description' => $validated['description'],
            'combat_suit_id' => $validated['combat_suit_id'] ?? null,
            'signature_ability_id' => $validated['signature_ability_id'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        // Sync relationships
        if (isset($validated['talents'])) {
            $character->talents()->sync($validated['talents']);
        }
        
        if (isset($validated['weaknesses'])) {
            $character->weaknesses()->sync($validated['weaknesses']);
        }

        return redirect()->route('admin.characters.index')
            ->with('success', 'Character created successfully.');
    }

    /**
     * Show the character details.
     */
    public function show(Character $character)
    {
        $character->load([
            'combatSuit.effects', 
            'signatureAbility',
            'talents',
            'weaknesses',
            'shortStories' => function ($query) {
                $query->orderByDesc('story_date')->orderBy('title');
            }
        ]);
        
        return view('admin.characters.show', compact('character'));
    }

    /**
     * Show the form for editing the specified character.
     */
    public function edit(Character $character)
    {
        $character->load(['talents', 'weaknesses']);
        
        $combatSuits = CombatSuit::orderBy('name')->get();
        $signatureAbilities = SignatureAbility::orderBy('name')->get();
        $talents = Talent::orderBy('category')->orderBy('name')->get();
        $weaknesses = Weakness::orderBy('name')->get();
        
        // Get current talents and weaknesses IDs for pre-selecting in the form
        $selectedTalents = $character->talents->pluck('id')->toArray();
        $selectedWeaknesses = $character->weaknesses->pluck('id')->toArray();
        
        return view('admin.characters.edit', compact(
            'character',
            'combatSuits', 
            'signatureAbilities', 
            'talents', 
            'weaknesses',
            'selectedTalents',
            'selectedWeaknesses'
        ));
    }

    /**
     * Update the specified character in storage.
     */
    public function update(Request $request, Character $character)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'player_name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'required|string',
            'combat_suit_id' => 'nullable|exists:combat_suits,id',
            'signature_ability_id' => 'nullable|exists:signature_abilities,id',
            'talents' => 'nullable|array',
            'talents.*' => 'exists:talents,id',
            'weaknesses' => 'nullable|array',
            'weaknesses.*' => 'exists:weaknesses,id',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($character->image) {
                Storage::disk('public')->delete($character->image);
            }
            
            $validated['image'] = $request->file('image')->store('characters', 'public');
        }

        // Update character
        $character->update([
            'name' => $validated['name'],
            'player_name' => $validated['player_name'],
            'image' => $validated['image'] ?? $character->image,
            'description' => $validated['description'],
            'combat_suit_id' => $validated['combat_suit_id'] ?? null,
            'signature_ability_id' => $validated['signature_ability_id'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        // Sync relationships
        $character->talents()->sync($validated['talents'] ?? []);
        $character->weaknesses()->sync($validated['weaknesses'] ?? []);

        return redirect()->route('admin.characters.index')
            ->with('success', 'Character updated successfully.');
    }

    /**
     * Remove the specified character from storage.
     */
    public function destroy(Character $character)
    {
        // Delete image if exists
        if ($character->image) {
            Storage::disk('public')->delete($character->image);
        }
        
        // Delete the character (will cascade to short stories)
        $character->delete();

        return redirect()->route('admin.characters.index')
            ->with('success', 'Character deleted successfully.');
    }
}