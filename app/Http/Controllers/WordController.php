<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Http\Requests\StoreWordRequest;
use App\Http\Requests\UpdateWordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class WordController extends Controller
{
    public function index(): JsonResponse
    {
        $words = Word::with(['translations'])->get();
        return response()->json($words);
    }

    public function store(StoreWordRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $word = Word::create($validated);
        
        return response()->json($word, Response::HTTP_CREATED);
    }

    public function show(Word $word): JsonResponse
    {
        return response()->json($word);
    }

    public function update(UpdateWordRequest $request, Word $word): JsonResponse
    {
        $validated = $request->validated();
        $word->update($validated);
        
        return response()->json($word);
    }

    public function destroy(Word $word): JsonResponse
    {
        $word->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}