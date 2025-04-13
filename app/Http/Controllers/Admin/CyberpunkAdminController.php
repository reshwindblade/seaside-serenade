<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\Npc;
use App\Models\Power;
use App\Models\Recap;
use App\Models\Rule;
use App\Models\WorldSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CyberpunkAdminController extends Controller
{
    /**
     * Show admin dashboard.
     */
    public function dashboard()
    {
        $stats = [
            'rules' => Rule::count(),
            'npcs' => Npc::count(),
            'characters' => Character::count(),
            'recaps' => Recap::count(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }

    // Rules management
    
    /**
     * Display a listing of rules.
     */
    public function rules()
    {
        $rules = Rule::orderBy('category')->orderBy('sort_order')->orderBy('name')->paginate(10);
        
        return view('admin.rules.index', compact('rules'));
    }

    /**
     * Show the form for creating a new rule.
     */
    public function createRule()
    {
        $categories = Rule::categories();
        
        return view('admin.rules.create', compact('categories'));
    }

    /**
     * Store a newly created rule in storage.
     */
    public function storeRule(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'description' => 'required|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $rule = Rule::create($validated);

        return redirect()->route('admin.rules.index')
            ->with('success', 'Rule created successfully.');
    }

    /**
     * Show the form for editing the specified rule.
     */
    public function editRule(Rule $rule)
    {
        $categories = Rule::categories();
        
        return view('admin.rules.edit', compact('rule', 'categories'));
    }

    /**
     * Update the specified rule in storage.
     */
    public function updateRule(Request $request, Rule $rule)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'description' => 'required|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $rule->update($validated);

        return redirect()->route('admin.rules.index')
            ->with('success', 'Rule updated successfully.');
    }

    /**
     * Remove the specified rule from storage.
     */
    public function destroyRule(Rule $rule)
    {
        $rule->delete();

        return redirect()->route('admin.rules.index')
            ->with('success', 'Rule deleted successfully.');
    }

    // NPCs management
    
    /**
     * Display a listing of NPCs.
     */
    public function npcs()
    {
        $npcs = Npc::orderBy('sort_order')->orderBy('name')->paginate(10);
        
        return view('admin.npcs.index', compact('npcs'));
    }

    /**
     * Show the form for creating a new NPC.
     */
    public function createNpc()
    {
        return view('admin.npcs.create');
    }

    /**
     * Store a newly created NPC in storage.
     */
    public function storeNpc(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'required|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('npcs', 'public');
        }

        $npc = Npc::create($validated);

        return redirect()->route('admin.npcs.index')
            ->with('success', 'NPC created successfully.');
    }

    /**
     * Show the form for editing the specified NPC.
     */
    public function editNpc(Npc $npc)
    {
        return view('admin.npcs.edit', compact('npc'));
    }

    /**
     * Update the specified NPC in storage.
     */
    public function updateNpc(Request $request, Npc $npc)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'required|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($npc->image) {
                Storage::disk('public')->delete($npc->image);
            }
            
            $validated['image'] = $request->file('image')->store('npcs', 'public');
        }

        $npc->update($validated);

        return redirect()->route('admin.npcs.index')
            ->with('success', 'NPC updated successfully.');
    }

    /**
     * Remove the specified NPC from storage.
     */
    public function destroyNpc(Npc $npc)
    {
        if ($npc->image) {
            Storage::disk('public')->delete($npc->image);
        }
        
        $npc->delete();

        return redirect()->route('admin.npcs.index')
            ->with('success', 'NPC deleted successfully.');
    }

    // Characters management
    
    /**
     * Display a listing of characters.
     */
    public function characters()
    {
        $characters = Character::orderBy('sort_order')->orderBy('name')->paginate(10);
        
        return view('admin.characters.index', compact('characters'));
    }

    /**
     * Show the form for creating a new character.
     */
    public function createCharacter()
    {
        return view('admin.characters.create');
    }

    /**
     * Store a newly created character in storage.
     */
    public function storeCharacter(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'player_name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'required|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('characters', 'public');
        }

        $character = Character::create($validated);

        return redirect()->route('admin.characters.index')
            ->with('success', 'Character created successfully.');
    }

    /**
     * Show the form for editing the specified character.
     */
    public function editCharacter(Character $character)
    {
        return view('admin.characters.edit', compact('character'));
    }

    /**
     * Update the specified character in storage.
     */
    public function updateCharacter(Request $request, Character $character)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'player_name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'required|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($character->image) {
                Storage::disk('public')->delete($character->image);
            }
            
            $validated['image'] = $request->file('image')->store('characters', 'public');
        }

        $character->update($validated);

        return redirect()->route('admin.characters.index')
            ->with('success', 'Character updated successfully.');
    }

    /**
     * Remove the specified character from storage.
     */
    public function destroyCharacter(Character $character)
    {
        if ($character->image) {
            Storage::disk('public')->delete($character->image);
        }
        
        $character->delete();

        return redirect()->route('admin.characters.index')
            ->with('success', 'Character deleted successfully.');
    }

    // World setting management
    
    /**
     * Display the world setting page for editing.
     */
    public function world()
    {
        $world = WorldSetting::getSetting();
        
        return view('admin.world.edit', compact('world'));
    }

    /**
     * Update the world setting.
     */
    public function updateWorld(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $world = WorldSetting::getSetting();
        $world->content = $validated['content'];
        $world->last_updated_by = Auth::id();
        $world->save();

        return redirect()->route('admin.world.index')
            ->with('success', 'World setting updated successfully.');
    }

    // Recaps management
    
    /**
     * Display a listing of recaps.
     */
    public function recaps()
    {
        $recaps = Recap::latest()->paginate(10);
        
        return view('admin.recaps.index', compact('recaps'));
    }

    /**
     * Show the form for creating a new recap.
     */
    public function createRecap()
    {
        return view('admin.recaps.create');
    }

    /**
     * Store a newly created recap in storage.
     */
    public function storeRecap(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'session_number' => 'required|integer|min:1',
            'session_date' => 'required|date',
            'content' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $validated['created_by'] = Auth::id();

        $recap = Recap::create($validated);

        return redirect()->route('admin.recaps.index')
            ->with('success', 'Recap created successfully.');
    }

    /**
     * Show the form for editing the specified recap.
     */
    public function editRecap(Recap $recap)
    {
        return view('admin.recaps.edit', compact('recap'));
    }

    /**
     * Update the specified recap in storage.
     */
    public function updateRecap(Request $request, Recap $recap)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'session_number' => 'required|integer|min:1',
            'session_date' => 'required|date',
            'content' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $recap->update($validated);

        return redirect()->route('admin.recaps.index')
            ->with('success', 'Recap updated successfully.');
    }

    /**
     * Remove the specified recap from storage.
     */
    public function destroyRecap(Recap $recap)
    {
        $recap->delete();

        return redirect()->route('admin.recaps.index')
            ->with('success', 'Recap deleted successfully.');
    }

    // Powers management
    
    /**
     * Display a listing of powers.
     */
    public function powers()
    {
        $powers = Power::orderBy('category')->orderBy('sort_order')->orderBy('name')->paginate(10);
        
        return view('admin.powers.index', compact('powers'));
    }

    /**
     * Show the form for creating a new power.
     */
    public function createPower()
    {
        $categories = Power::categories();
        
        return view('admin.powers.create', compact('categories'));
    }

    /**
     * Store a newly created power in storage.
     */
    public function storePower(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'mechanics' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $power = Power::create($validated);

        return redirect()->route('admin.powers.index')
            ->with('success', 'Power created successfully.');
    }

    /**
     * Show the form for editing the specified power.
     */
    public function editPower(Power $power)
    {
        $categories = Power::categories();
        
        return view('admin.powers.edit', compact('power', 'categories'));
    }

    /**
     * Update the specified power in storage.
     */
    public function updatePower(Request $request, Power $power)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'mechanics' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $power->update($validated);

        return redirect()->route('admin.powers.index')
            ->with('success', 'Power updated successfully.');
    }

    /**
     * Remove the specified power from storage.
     */
    public function destroyPower(Power $power)
    {
        $power->delete();

        return redirect()->route('admin.powers.index')
            ->with('success', 'Power deleted successfully.');
    }
}