<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    /** @use HasFactory<\Database\Factories\TranslationFactory> */
    use HasFactory;

    protected $fillable = [
        'word_id',
        'language_code',
        'translation',
    ];

    public function word()
    {
        return $this->belongsTo(Word::class, 'word_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_code');
    }
}
