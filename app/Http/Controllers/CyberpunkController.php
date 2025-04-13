<?php
// app/Http/Controllers/CyberpunkController.php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Npc;
use App\Models\Power;
use App\Models\Recap;
use App\Models\Rule;
use App\Models\WorldSetting;
use Illuminate\Http\Request;

class CyberpunkController extends Controller
{
    /**
     * Show the home page.
     */
    public function home()
    {
        return view('cyberpunk.home');
    }

    /**
     * Show the rules page.
     */
    public function rules(Request $request)
    {
        $category = $request->query('category');
        
        $categories = Rule::categories();
        
        $rules = Rule::active()
            ->when($category, function ($query) use ($category) {
                return $query->where('category', $category);
            })
            ->ordered()
            ->get();
        
        return view('cyberpunk.rules', compact('rules', 'categories', 'category'));
    }

    /**
     * Show the NPCs page.
     */
    public function npcs()
    {
        $npcs = Npc::active()->ordered()->get();
        
        return view('cyberpunk.npcs', compact('npcs'));
    }

    /**
     * Show a specific NPC.
     */
    public function showNpc($id)
    {
        $npc = Npc::active()->findOrFail($id);
        
        return view('cyberpunk.npc-detail', compact('npc'));
    }

    /**
     * Show the world setting page.
     */
    public function world()
    {
        $world = WorldSetting::getSetting();
        
        return view('cyberpunk.world', compact('world'));
    }

    /**
     * Show the recaps page.
     */
    public function recaps()
    {
        $recaps = Recap::active()->latest()->get();
        
        return view('cyberpunk.recaps', compact('recaps'));
    }

   public function combatSuits()
    {
        $suits = CombatSuit::active()->ordered()->with('effects')->get();
        return view('cyberpunk.combat-suits', compact('suits'));
    }

    public function talents(Request $request)
    {
        $category = $request->query('category');
        $categories = Talent::categories();
        
        $talents = Talent::active()
            ->when($category, function ($query) use ($category) {
                return $query->where('category', $category);
            })
            ->ordered()
            ->get();
        
        return view('cyberpunk.talents', compact('talents', 'categories', 'category'));
    }

    public function weaknesses()
    {
        $weaknesses = Weakness::active()->ordered()->get();
        return view('cyberpunk.weaknesses', compact('weaknesses'));
    }

    public function signatureAbilities()
    {
        $abilities = SignatureAbility::active()->ordered()->get();
        return view('cyberpunk.signature-abilities', compact('abilities'));
    }

    public function shortStories()
    {
        $stories = ShortStory::active()
            ->with('character')
            ->latest()
            ->get();
        return view('cyberpunk.short-stories', compact('stories'));
    }

    /**
     * Show the powers page.
     */
    public function powers(Request $request)
    {
        // For now, just show a "Coming Soon" page
        return view('cyberpunk.powers');
    }

    public function combatSuitDetail($id)
    {
        $suit = CombatSuit::with('effects')->findOrFail($id);
        return view('cyberpunk.combat-suit-detail', compact('suit'));
    }

    public function talentDetail($id)
    {
        $talent = Talent::findOrFail($id);
        return view('cyberpunk.talent-detail', compact('talent'));
    }

    public function weaknessDetail($id)
    {
        $weakness = Weakness::findOrFail($id);
        return view('cyberpunk.weakness-detail', compact('weakness'));
    }

    public function signatureAbilityDetail($id)
    {
        $ability = SignatureAbility::findOrFail($id);
        return view('cyberpunk.signature-ability-detail', compact('ability'));
    }

    public function shortStoryDetail($id)
    {
        $story = ShortStory::with('character')->findOrFail($id);
        return view('cyberpunk.short-story-detail', compact('story'));
    }
}