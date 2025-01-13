<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // User can edit their profile
    public function edit(Request $request): JsonResponse
    {
        // Get user
        $user = Auth::user();

        // Check if user is not null
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Check the validation of the fields
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|confirmed|min:8',
            'mother_language' => 'sometimes|string',
            'target_language' => 'sometimes|string',
        ]);

        // Hash the password if it's being updated
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        // Update user
        $user->update($validated);

        return response()->json($user);
    }
}
