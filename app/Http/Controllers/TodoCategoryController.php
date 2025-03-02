<?php

namespace App\Http\Controllers;

use App\Models\TodoCategory;
use App\Http\Requests\StoreTodoCategoryRequest;
use App\Http\Requests\UpdateTodoCategoryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TodoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $userId = Auth::id();
        $todo_categories = TodoCategory::where('user_id', $userId)->get();
        return response()->json($todo_categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoCategoryRequest $request): JsonResponse
    {
        $validated = $request->validated();
        
        $todo_category = TodoCategory::create([
            'title' => $validated['title'],
            'color' => $validated['color'] ?? null,
            'user_id' => Auth::id()
        ]);

        return response()->json($todo_category, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(TodoCategory $todoCategory): JsonResponse
    {
        return response()->json($todoCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoCategoryRequest $request, TodoCategory $todoCategory): JsonResponse
    {
        $validated = $request->validated();
        $todoCategory->update($validated);

        return response()->json($todoCategory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TodoCategory $todoCategory): JsonResponse
    {
        $todoCategory->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
