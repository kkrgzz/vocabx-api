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
    ];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
