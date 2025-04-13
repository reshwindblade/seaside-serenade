<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Talent;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    /**
     * Display a listing of active characters.
     */
    public function index()
    {
        $characters = Character::active()->ordered()->get();
        
        return view('cyberpunk.characters', compact('characters'));
    }

    /**
     * Display the specified character.
     */
    public function show($id)
    {
        $character = Character::active()
            ->with([
                'combatSuit.effects', 
                'signatureAbility',
                'talents' => function ($query) {
                    $query->where('is_active', true)
                          ->orderBy('category')
                          ->orderBy('name');
                },
                'weaknesses' => function ($query) {
                    $query->where('is_active', true)
                          ->orderBy('name');
                },
                'shortStories' => function ($query) {
                    $query->where('is_active', true)
                          ->orderByDesc('story_date')
                          ->orderBy('title');
                }
            ])
            ->findOrFail($id);
        
        // Group talents by category
        $talentCategories = $character->talents->groupBy('category');
        
        return view('cyberpunk.character-detail', compact('character', 'talentCategories'));
    }
}