<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LanguageController extends Controller
{
    public function index(): JsonResponse
    {
        $languages = Language::all();
        return response()->json($languages);
    }

    public function store(StoreLanguageRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $language = Language::create($validated);
        
        return response()->json($language, Response::HTTP_CREATED);
    }

    public function show(Language $language): JsonResponse
    {
        return response()->json($language);
    }

    public function update(UpdateLanguageRequest $request, Language $language): JsonResponse
    {
        $validated = $request->validated();
        $language->update($validated);
        
        return response()->json($language);
    }

    public function destroy(Language $language): JsonResponse
    {
        $language->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}