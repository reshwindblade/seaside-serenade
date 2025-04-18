<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    /**
     * Display a listing of the rules.
     */
    public function index()
    {
        return view('pages.rules');
    }

    /**
     * Display the specified rule.
     */
    public function show(Rule $rule)
    {
        if (!$rule->is_active) {
            abort(404);
        }
        
        // Get related rules from the same category
        $relatedRules = Rule::active()
            ->where('id', '!=', $rule->id)
            ->byCategory($rule->category)
            ->ordered()
            ->limit(3)
            ->get();
            
        return view('pages.rules.show', compact('rule', 'relatedRules'));
    }
}