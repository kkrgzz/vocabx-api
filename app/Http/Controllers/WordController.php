<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Http\Requests\StoreWordRequest;
use App\Http\Requests\UpdateWordRequest;
use App\Models\Translation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class WordController extends Controller
{
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

        $words = Word::with(['translations', 'language', 'sentences'])
            ->orderBy('created_at', $sortOrder)
            ->paginate($perPage);

        return response()->json($words);
    }

    public function userWords(Request $request): JsonResponse
    {
        $perPage = 10;
        $validated = $request->validate([
            'perPage' => 'sometimes|integer|min:1',
            'sort' => 'sometimes|in:asc,desc',
            'language_code' => 'sometimes|string|exists:languages,code'
        ]);

        if ($request->has('perPage')) {
            $perPage = $validated['perPage'];
        }

        $sortOrder = $request->input('sort', 'asc');
        $userId = Auth::id();

        $query = Word::where('user_id', $userId)
            ->with(['translations.language', 'language', 'sentences'])
            ->orderBy('created_at', $sortOrder);

        if ($request->has('language_code')) {
            $query->where('language_code', $request->input('language_code'));
        }

        $words = $query->paginate($perPage);

        return response()->json($words);
    }

    public function store(StoreWordRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $word = Word::create($validated);

        if ($request->has('translations')) {
            foreach ($request->input('translations') as $translationData) {
                $translationData['word_id'] = $word->id;
                Translation::create($translationData);
            }
        }

        return response()->json($word->load('translations'), Response::HTTP_CREATED);
    }

    public function show(Word $word): JsonResponse
    {
        return response()->json($word);
    }

    public function update(UpdateWordRequest $request, Word $word): JsonResponse
    {
        $validated = $request->validated();
        $word->update($validated);

        if ($request->has('translations')) {
            foreach ($request->input('translations') as $translationData) {
                $translation = Translation::updateOrCreate(
                    [
                        'word_id' => $word->id,
                        'language_code' => $translationData['language_code']
                    ],
                    [
                        'translation' => $translationData['translation']
                    ]
                );
            }
        }

        return response()->json($word->load('translations'));
    }

    public function destroy(Word $word): JsonResponse
    {
        $word->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
