<?php

namespace App\Http\Controllers;

use App\Models\Sentence;
use App\Http\Requests\StoreSentenceRequest;
use App\Http\Requests\UpdateSentenceRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SentenceController extends Controller
{
    public function index(): JsonResponse
    {
        $sentences = Sentence::with('word')->get();
        return response()->json($sentences);
    }

    public function store(StoreSentenceRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $sentences = [];

        if ($request->has('sentences')) {
            foreach ($request->input('sentences') as $sentenceData) {
                $sentences[] = Sentence::create($sentenceData);
            }
        } else {
            $sentences[] = Sentence::create($validated);
        }

        return response()->json($sentences, Response::HTTP_CREATED);
    }

    public function show(Sentence $sentence): JsonResponse
    {
        return response()->json($sentence->load('word'));
    }

    public function update(UpdateSentenceRequest $request, Sentence $sentence): JsonResponse
    {
        $validated = $request->validated();
        $sentence->update($validated);

        return response()->json($sentence);
    }

    public function bulkUpdate(UpdateSentenceRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $updatedSentences = [];

        foreach ($request->input('sentences') as $sentenceData) {
            $sentence = Sentence::find($sentenceData['id']);
            if ($sentence) {
                $sentence->update(['sentence' => $sentenceData['sentence']]);
                $updatedSentences[] = $sentence->load('word');
            }
        }

        return response()->json($updatedSentences);
    }

    public function destroy(Sentence $sentence): JsonResponse
    {
        $sentence->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
