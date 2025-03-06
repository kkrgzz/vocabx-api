<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Http\Requests\StoreWordRequest;
use App\Http\Requests\UpdateWordRequest;
use App\Models\Sentence;
use App\Models\Translation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    public function export(Request $request): StreamedResponse
    {
        $userId = Auth::id();
        $words = Word::where('user_id', $userId)
            ->with(['translations.language', 'language', 'sentences'])
            ->get();

        $callback = function () use ($words) {
            $file = fopen('php://output', 'w');
            fwrite($file, json_encode($words, JSON_PRETTY_PRINT));
            fclose($file);
        };

        $headers = [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="words.json"',
        ];

        return response()->stream($callback, 200, $headers);
    }

    public function import(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'required|file|mimes:json',
        ]);

        $file = $request->file('file');
        $data = json_decode(file_get_contents($file->getRealPath()), true);

        $importedCount = 0;
        $duplicateCount = 0;
        $errorCount = 0;
        $passedCount = 0;

        foreach ($data as $wordData) {
            try {
                $wordData['user_id'] = Auth::id();
                $translations = $wordData['translations'] ?? [];
                $sentences = $wordData['sentences'] ?? [];

                unset($wordData['translations'], $wordData['sentences']);

                // Check for duplicate word
                $existingWord = Word::where('user_id', $wordData['user_id'])
                    ->where('word', $wordData['word'])
                    ->where('language_code', $wordData['language_code'])
                    ->first();

                if ($existingWord) {
                    $duplicateCount++;
                    continue;
                }

                $word = Word::create($wordData);
                $importedCount++;

                foreach ($translations as $translationData) {
                    $translationData['word_id'] = $word->id;
                    Translation::create($translationData);
                }

                foreach ($sentences as $sentenceData) {
                    $sentenceData['word_id'] = $word->id;
                    Sentence::create($sentenceData);
                }
            } catch (\Exception $e) {
                $errorCount++;
                continue;
            }
        }

        $passedCount = count($data) - ($importedCount + $duplicateCount + $errorCount);

        return response()->json([
            'message' => 'Import process completed',
            'imported' => $importedCount,
            'duplicates' => $duplicateCount,
            'errors' => $errorCount,
            'passed' => $passedCount,
        ], Response::HTTP_CREATED);
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
