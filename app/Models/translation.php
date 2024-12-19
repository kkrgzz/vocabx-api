<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class translation extends Model
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
        return $this->belongsTo(word::class);
    }

    public function language()
    {
        return $this->belongsTo(language::class, 'language_code');
    }
}
