<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $languages = Language::all();
        return response()->json($languages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLanguageRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $language = Language::create($validated);

        return response()->json($language, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language): JsonResponse
    {
        return response()->json($language);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLanguageRequest $request, Language $language): JsonResponse
    {
        $validated = $request->validated();
        $language->update($validated);

        return response()->json($language);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language): JsonResponse
    {
        $language->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
