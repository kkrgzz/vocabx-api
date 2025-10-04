<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    /** @use HasFactory<\Database\Factories\SentenceFactory> */
    use HasFactory;

    protected $fillable = [
        'word_id',
        'sentence',
        'is_tatoeba_imported',
        'tatoeba_id',
        'is_ai_generated',
        'ai_review',
        'ai_elapsed_time',
        'ai_prompt_tokens',
        'ai_completion_tokens',
    ];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
