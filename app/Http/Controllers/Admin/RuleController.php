<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RuleController extends Controller
{
    /**
     * Display a listing of the rules.
     */
    public function index(Request $request)
    {
        $rules = Rule::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('category', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($request->category, function ($query, $category) {
                $query->where('category', $category);
            })
            ->when($request->status !== null, function ($query) use ($request) {
                $query->where('is_active', $request->status);
            })
            ->orderBy($request->sort_field ?? 'created_at', $request->sort_direction ?? 'desc')
            ->paginate($request->per_page ?? 10);
        
        $categories = Rule::distinct('category')->pluck('category');
        
        return response()->json([
            'rules' => $rules,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created rule.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'is_active' => 'boolean',
            'order' => 'integer|nullable',
        ]);
        
        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);
        
        // Ensure slug is unique
        $count = 0;
        $originalSlug = $validated['slug'];
        while (Rule::where('slug', $validated['slug'])->exists()) {
            $count++;
            $validated['slug'] = $originalSlug . '-' . $count;
        }
        
        $rule = Rule::create($validated);
        
        return response()->json([
            'message' => 'Rule created successfully',
            'rule' => $rule
        ], 201);
    }

    /**
     * Display the specified rule.
     */
    public function show(Rule $rule)
    {
        return response()->json(['rule' => $rule]);
    }

    /**
     * Update the specified rule.
     */
    public function update(Request $request, Rule $rule)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'category' => 'sometimes|required|string|max:100',
            'description' => 'sometimes|required|string',
            'is_active' => 'sometimes|boolean',
            'order' => 'sometimes|integer|nullable',
        ]);
        
        // Update slug if name changed
        if (isset($validated['name']) && $validated['name'] !== $rule->name) {
            $validated['slug'] = Str::slug($validated['name']);
            
            // Ensure slug is unique
            $count = 0;
            $originalSlug = $validated['slug'];
            while (Rule::where('slug', $validated['slug'])->where('id', '!=', $rule->id)->exists()) {
                $count++;
                $validated['slug'] = $originalSlug . '-' . $count;
            }
        }
        
        $rule->update($validated);
        
        return response()->json([
            'message' => 'Rule updated successfully',
            'rule' => $rule
        ]);
    }

    /**
     * Remove the specified rule.
     */
    public function destroy(Rule $rule)
    {
        $rule->delete();
        
        return response()->json([
            'message' => 'Rule deleted successfully'
        ]);
    }
}