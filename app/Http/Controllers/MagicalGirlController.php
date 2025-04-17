<?php

namespace App\Http\Controllers;

use App\Models\MagicalGirl;
use App\Models\MagicalSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MagicalGirlController extends Controller
{
    /**
     * Display the character creation form.
     */
    public function create()
    {
        // If user already has a character, redirect to edit
        if (Auth::user()->hasMagicalGirl()) {
            return redirect()->route('magical-girl.edit')
                ->with('info', 'You already have a magical girl character.');
        }
        
        // Get skills organized by attribute
        $skillsByAttribute = MagicalSkill::getSkillsByAttribute();
        
        // Return the character creation form
        return view('magical-girl.create', [
            'skillsByAttribute' => $skillsByAttribute,
        ]);
    }
    
    /**
     * Store a new magical girl character.
     */
    public function store(Request $request)
    {
        // If user already has a character, redirect to edit
        if (Auth::user()->hasMagicalGirl()) {
            return redirect()->route('magical-girl.edit')
                ->with('info', 'You already have a magical girl character.');
        }
        
        // Validate basic info
        $validator = Validator::make($request->all(), [
            'character_name' => 'required|string|max:255',
            'magical_name' => 'required|string|max:255',
            'signature_color' => 'required|string|max:255',
            'animation_spirit' => 'required|string|max:255',
            'transformation_phrase' => 'required|string',
            'bio' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Validate attributes
        $attributes = [
            'focus' => $request->input('focus', 6),
            'daring' => $request->input('daring', 6),
            'insight' => $request->input('insight', 6),
            'presence' => $request->input('presence', 6),
            'might' => $request->input('might', 6),
        ];
        
        $totalPoints = array_sum($attributes);
        $minPoints = 6;
        $maxPoints = 12;
        
        // Check if total points is 45
        if ($totalPoints !== 45) {
            return redirect()->back()
                ->withErrors(['attributes' => 'Total attribute points must be exactly 45.'])
                ->withInput();
        }
        
        // Check individual attribute limits
        foreach ($attributes as $attribute => $value) {
            if ($value < $minPoints || $value > $maxPoints) {
                return redirect()->back()
                    ->withErrors([$attribute => "The $attribute attribute must be between $minPoints and $maxPoints."])
                    ->withInput();
            }
        }
        
        // Validate skills
        $proficientSkills = $request->input('proficient_skills', []);
        $masteredSkills = $request->input('mastered_skills', []);
        
        // Check if proficient skills count is 5
        if (count($proficientSkills) !== 5) {
            return redirect()->back()
                ->withErrors(['proficient_skills' => 'You must select exactly 5 proficient skills.'])
                ->withInput();
        }
        
        // Check if mastered skills count is 2
        if (count($masteredSkills) !== 2) {
            return redirect()->back()
                ->withErrors(['mastered_skills' => 'You must select exactly 2 mastered skills.'])
                ->withInput();
        }
        
        // Check if mastered skills are also proficient
        foreach ($masteredSkills as $masteredSkill) {
            if (!in_array($masteredSkill, $proficientSkills)) {
                return redirect()->back()
                    ->withErrors(['mastered_skills' => 'Mastered skills must also be proficient.'])
                    ->withInput();
            }
        }
        
        // Create magical girl character
        $magicalGirl = new MagicalGirl([
            'user_id' => Auth::id(),
            'character_name' => $request->input('character_name'),
            'magical_name' => $request->input('magical_name'),
            'signature_color' => $request->input('signature_color'),
            'animation_spirit' => $request->input('animation_spirit'),
            'transformation_phrase' => $request->input('transformation_phrase'),
            'focus' => $attributes['focus'],
            'daring' => $attributes['daring'],
            'insight' => $attributes['insight'],
            'presence' => $attributes['presence'],
            'might' => $attributes['might'],
            'proficient_skills' => $proficientSkills,
            'mastered_skills' => $masteredSkills,
            'bio' => $request->input('bio'),
        ]);
        
        // Calculate derived stats
        $magicalGirl->calculateDerivedStats();
        
        // Save the character
        $magicalGirl->save();
        
        return redirect()->route('magical-girl.show')
            ->with('success', 'Your magical girl character has been created!');
    }
    
    /**
     * Display the user's magical girl character.
     */
    public function show()
    {
        // Check if user has a character
        if (!Auth::user()->hasMagicalGirl()) {
            return redirect()->route('magical-girl.create')
                ->with('info', 'You need to create a magical girl character first.');
        }
        
        $magicalGirl = Auth::user()->magicalGirl;
        $skillNames = MagicalSkill::getAllSkillsArray();
        
        return view('magical-girl.show', [
            'magicalGirl' => $magicalGirl,
            'skillNames' => $skillNames,
        ]);
    }
    
    /**
     * Display the edit form.
     */
    public function edit()
    {
        // Check if user has a character
        if (!Auth::user()->hasMagicalGirl()) {
            return redirect()->route('magical-girl.create')
                ->with('info', 'You need to create a magical girl character first.');
        }
        
        $magicalGirl = Auth::user()->magicalGirl;
        $skillsByAttribute = MagicalSkill::getSkillsByAttribute();
        
        return view('magical-girl.edit', [
            'magicalGirl' => $magicalGirl,
            'skillsByAttribute' => $skillsByAttribute,
        ]);
    }
    
    /**
     * Update the user's magical girl character.
     */
    public function update(Request $request)
    {
        // Check if user has a character
        if (!Auth::user()->hasMagicalGirl()) {
            return redirect()->route('magical-girl.create')
                ->with('info', 'You need to create a magical girl character first.');
        }
        
        $magicalGirl = Auth::user()->magicalGirl;
        
        // Same validation as store method (could be refactored)
        // For brevity, we're only updating basic info and bio here
        $validator = Validator::make($request->all(), [
            'character_name' => 'required|string|max:255',
            'magical_name' => 'required|string|max:255',
            'signature_color' => 'required|string|max:255',
            'animation_spirit' => 'required|string|max:255',
            'transformation_phrase' => 'required|string',
            'bio' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Update basic info
        $magicalGirl->character_name = $request->input('character_name');
        $magicalGirl->magical_name = $request->input('magical_name');
        $magicalGirl->signature_color = $request->input('signature_color');
        $magicalGirl->animation_spirit = $request->input('animation_spirit');
        $magicalGirl->transformation_phrase = $request->input('transformation_phrase');
        $magicalGirl->bio = $request->input('bio');
        
        // Save the changes
        $magicalGirl->save();
        
        return redirect()->route('magical-girl.show')
            ->with('success', 'Your magical girl character has been updated!');
    }
}