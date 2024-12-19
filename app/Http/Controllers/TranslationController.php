<?php
namespace App\Http\Controllers;

use App\Models\Translation;
use App\Http\Requests\StoreTranslationRequest;
use App\Http\Requests\UpdateTranslationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TranslationController extends Controller
{
    public function index(): JsonResponse
    {
        $translations = Translation::with(['word', 'language'])->get();
        return response()->json($translations);
    }

    public function store(StoreTranslationRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $translation = Translation::create($validated);
        
        return response()->json($translation->load(['word', 'language']), Response::HTTP_CREATED);
    }

    public function show(Translation $translation): JsonResponse
    {
        return response()->json($translation->load(['word', 'language']));
    }

    public function update(UpdateTranslationRequest $request, Translation $translation): JsonResponse
    {
        $validated = $request->validated();
        $translation->update($validated);
        
        return response()->json($translation->load(['word', 'language']));
    }

    public function destroy(Translation $translation): JsonResponse
    {
        $translation->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}