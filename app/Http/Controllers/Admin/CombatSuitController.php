<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CombatSuit;
use App\Models\CombatSuitEffect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CombatSuitController extends Controller
{
    /**
     * Display a listing of combat suits.
     */
    public function index()
    {
        $suits = CombatSuit::with('effects')->orderBy('name')->paginate(10);
        return view('admin.suits.index', compact('suits'));
    }

    /**
     * Show the form for creating a new combat suit.
     */
    public function create()
    {
        return view('admin.suits.create');
    }

    /**
     * Store a newly created combat suit in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
            'effects' => 'sometimes|array',
            'effects.*.name' => 'required|string|max:255',
            'effects.*.description' => 'nullable|string',
            'effects.*.power_rating' => 'required|integer',
            'effects.*.sort_order' => 'integer|min:0',
        ]);

        // Create the combat suit
        $suit = CombatSuit::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'power_rating' => 0, // Will be calculated from effects
            'is_active' => $validated['is_active'] ?? true,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        // Add effects if provided
        if (isset($validated['effects']) && is_array($validated['effects'])) {
            foreach ($validated['effects'] as $effectData) {
                $suit->effects()->create([
                    'name' => $effectData['name'],
                    'description' => $effectData['description'] ?? null,
                    'power_rating' => $effectData['power_rating'],
                    'sort_order' => $effectData['sort_order'] ?? 0,
                ]);
            }
        }

        // Update power rating
        $suit->updatePowerRating();

        return redirect()->route('admin.suits.index')
            ->with('success', 'Combat Suit created successfully.');
    }

    /**
     * Show the form for editing the specified combat suit.
     */
    public function edit(CombatSuit $suit)
    {
        $suit->load('effects');
        return view('admin.suits.edit', compact('suit'));
    }

    /**
     * Update the specified combat suit in storage.
     */
    public function update(Request $request, CombatSuit $suit)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
            'effects' => 'sometimes|array',
            'effects.*.id' => 'sometimes|exists:combat_suit_effects,id',
            'effects.*.name' => 'required|string|max:255',
            'effects.*.description' => 'nullable|string',
            'effects.*.power_rating' => 'required|integer',
            'effects.*.sort_order' => 'integer|min:0',
        ]);

        // Update the combat suit
        $suit->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        // Handle effects updates
        if (isset($validated['effects']) && is_array($validated['effects'])) {
            // Track existing effect IDs to determine which to delete
            $existingEffectIds = $suit->effects->pluck('id')->toArray();
            $updatedEffectIds = [];

            foreach ($validated['effects'] as $effectData) {
                if (isset($effectData['id'])) {
                    // Update existing effect
                    $effect = CombatSuitEffect::find($effectData['id']);
                    if ($effect && $effect->combat_suit_id == $suit->id) {
                        $effect->update([
                            'name' => $effectData['name'],
                            'description' => $effectData['description'] ?? null,
                            'power_rating' => $effectData['power_rating'],
                            'sort_order' => $effectData['sort_order'] ?? 0,
                        ]);
                        $updatedEffectIds[] = $effect->id;
                    }
                } else {
                    // Create new effect
                    $effect = $suit->effects()->create([
                        'name' => $effectData['name'],
                        'description' => $effectData['description'] ?? null,
                        'power_rating' => $effectData['power_rating'],
                        'sort_order' => $effectData['sort_order'] ?? 0,
                    ]);
                    $updatedEffectIds[] = $effect->id;
                }
            }

            // Delete effects that weren't in the update
            $deleteEffectIds = array_diff($existingEffectIds, $updatedEffectIds);
            if (!empty($deleteEffectIds)) {
                CombatSuitEffect::whereIn('id', $deleteEffectIds)->delete();
            }
        }

        // Update power rating
        $suit->updatePowerRating();

        return redirect()->route('admin.suits.index')
            ->with('success', 'Combat Suit updated successfully.');
    }

    /**
     * Remove the specified combat suit from storage.
     */
    public function destroy(CombatSuit $suit)
    {
        // Delete the combat suit (will cascade to effects)
        $suit->delete();

        return redirect()->route('admin.suits.index')
            ->with('success', 'Combat Suit deleted successfully.');
    }
}