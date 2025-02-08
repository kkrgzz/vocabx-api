<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use App\Http\Requests\StoreMoodRequest;
use App\Http\Requests\UpdateMoodRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
    public function index(): JsonResponse
    {
        $moods = Mood::where('user_id', Auth::id())->get();
        return response()->json($moods);
    }

    public function store(StoreMoodRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $mood = Mood::create([
            'mood_score' => $validated['mood_score'],
            'feelings'   => $validated['feelings'] ?? null,
            'user_id'    => Auth::id()
        ]);

        return response()->json($mood, Response::HTTP_CREATED);
    }

    public function show(Mood $mood): JsonResponse
    {
        return response()->json($mood);
    }

    public function latestMoods(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'count' => 'sometimes|integer|min:1',
        ]);

        $count = $validated['count'] ?? 6; // Default to 5 if not provided

        $moods = Mood::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take($count)
            ->get();

        return response()->json($moods);
    }
    
    public function update(UpdateMoodRequest $request, Mood $mood): JsonResponse
    {
        $validated = $request->validated();
        $mood->update($validated);

        return response()->json($mood);
    }

    public function destroy(Mood $mood): JsonResponse
    {
        $mood->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
