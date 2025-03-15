<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Http\Requests\StoreUserProfileRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * Display the authenticated user's profile.
     */
    public function index(): JsonResponse
    {
        $userId = Auth::id();
        $userProfile = UserProfile::where('user_id', $userId)->firstOrFail();
        return response()->json($userProfile);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserProfileRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
    
        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
        }

        $userProfile = UserProfile::create($validated);
        return response()->json($userProfile, 201);
    }

    /**
     * Display the authenticated user's profile.
     */
    public function show(): JsonResponse
    {
        $userId = Auth::id();
        $userProfile = UserProfile::where('user_id', $userId)->firstOrFail();
        return response()->json($userProfile);
    }

    /**
     * Update the authenticated user's profile.
     */
    public function update(UpdateUserProfileRequest $request): JsonResponse
    {
        $userId = Auth::id();
        $userProfile = UserProfile::where('user_id', $userId)->firstOrFail();
        $validated = $request->validated();
        Log::info($request->all());
        if ($request->hasFile('profile_image')) {
            // Delete the old image if exists
            if ($userProfile->profile_image) {
                Storage::disk('public')->delete($userProfile->profile_image);
            }
            $validated['profile_image'] = $request->file('profile_image')->store('profile_images', 'public');
        }

        $userProfile->update($validated);
        return response()->json($userProfile);
    }

    /**
     * Remove the authenticated user's profile.
     */
    public function destroy(): JsonResponse
    {
        $userId = Auth::id();
        $userProfile = UserProfile::where('user_id', $userId)->firstOrFail();

        // Delete the profile image if exists
        if ($userProfile->profile_image) {
            Storage::disk('public')->delete($userProfile->profile_image);
        }

        $userProfile->delete();
        return response()->json(null, 204);
    }
}
