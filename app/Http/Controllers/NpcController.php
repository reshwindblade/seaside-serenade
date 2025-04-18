<?php

namespace App\Http\Controllers;

use App\Models\Npc;
use Illuminate\Http\Request;

class NpcController extends Controller
{
    /**
     * Display a listing of the NPCs.
     */
    public function index()
    {
        return view('pages.npcs');
    }

    /**
     * Display the specified NPC.
     */
    public function show(Npc $npc)
    {
        if (!$npc->is_active) {
            abort(404);
        }
        
        // Get related NPCs
        $relatedNpcs = Npc::active()
            ->where('id', '!=', $npc->id)
            ->ordered()
            ->inRandomOrder()
            ->limit(3)
            ->get();
            
        return view('pages.npcs.show', compact('npc', 'relatedNpcs'));
    }
}