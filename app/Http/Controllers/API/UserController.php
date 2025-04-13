<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Get a paginated list of all users
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $perPage = min($perPage, 100); // Limit maximum per page
        
        $users = User::paginate($perPage);
        
        return response()->json($users);
    }
    
    /**
     * Get a specific user by ID
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        
        return response()->json([
            'data' => $user
        ]);
    }
    
    /**
     * Create a new user
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|min:10|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        
        return response()->json([
            'data' => $user
        ], 201);
    }
    
    /**
     * Update an existing user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'sometimes|string|min:10|max:15',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $user->update($request->only(['name', 'email', 'phone']));
        
        return response()->json([
            'data' => $user
        ]);
    }
}