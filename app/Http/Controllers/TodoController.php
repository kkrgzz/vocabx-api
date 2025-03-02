<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = 10;
        $validated = $request->validate([
            'perPage' => 'sometimes|integer|min:1',
            'sort' => 'sometimes|in:asc,desc',
        ]);
        if ($request->has('perPage')) {
            $perPage = $validated['perPage'];
        }

        $sortOrder = $request->input('sort', 'asc');
        $userId = Auth::id();

        $todos = Todo::where('user_id', $userId)
            ->with(['category'])
            ->orderBy('created_at', $sortOrder)
            ->paginate($perPage);

        return response()->json($todos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $todo = Todo::create($validated);

        return response()->json($todo, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo): JsonResponse
    {
        return response()->json($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $validated = $request->validated();
        $todo->update($validated);

        return response()->json($todo, Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
