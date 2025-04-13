<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SignatureAbility;
use Illuminate\Http\Request;

class SignatureAbilityController extends Controller
{
    /**
     * Display a listing of signature abilities.
     */
    public function index()
    {
        $abilities = SignatureAbility::orderBy('name')->paginate(10);
        return view('admin.abilities.index', compact('abilities'));
    }

    /**
     * Show the form for creating a new signature ability.
     */
    public function create()
    {
        return view('admin.abilities.create');
    }

    /**
     * Store a newly created signature ability in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'effect' => 'nullable|string',
            'cooldown' => 'nullable|string|max:255',
            'power_rating' => 'required|integer',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        SignatureAbility::create($validated);

        return redirect()->route('admin.abilities.index')
            ->with('success', 'Signature Ability created successfully.');
    }

    /**
     * Show the form for editing the specified signature ability.
     */
    public function edit(SignatureAbility $ability)
    {
        return view('admin.abilities.edit', compact('ability'));
    }

    /**
     * Update the specified signature ability in storage.
     */
    public function update(Request $request, SignatureAbility $ability)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'effect' => 'nullable|string',
            'cooldown' => 'nullable|string|max:255',
            'power_rating' => 'required|integer',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $ability->update($validated);

        return redirect()->route('admin.abilities.index')
            ->with('success', 'Signature Ability updated successfully.');
    }

    /**
     * Remove the specified signature ability from storage.
     */
    public function destroy(SignatureAbility $ability)
    {
        $ability->delete();

        return redirect()->route('admin.abilities.index')
            ->with('success', 'Signature Ability deleted successfully.');
    }
}