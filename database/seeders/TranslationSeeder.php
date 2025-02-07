<?php

namespace Database\Seeders;

use App\Models\Translation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $translations = [
            ['word_id' => 3, 'language_code' => 'tr', 'translation' => 'tahtı terk etmek'],
            ['word_id' => 3, 'language_code' => 'fr', 'translation' => 'abdiquer'],
            ['word_id' => 3, 'language_code' => 'de', 'translation' => 'abdizieren'],

            ['word_id' => 5, 'language_code' => 'tr', 'translation' => 'nefret etmek'],
            ['word_id' => 5, 'language_code' => 'fr', 'translation' => 'abhor'],
            ['word_id' => 5, 'language_code' => 'de', 'translation' => 'verabscheuen'],

            ['word_id' => 6, 'language_code' => 'tr', 'translation' => 'kalmak'],
            ['word_id' => 6, 'language_code' => 'fr', 'translation' => 'respecter'],
            ['word_id' => 6, 'language_code' => 'de', 'translation' => 'bleiben'],

            ['word_id' => 8, 'language_code' => 'tr', 'translation' => 'yemin etmek'],
            ['word_id' => 8, 'language_code' => 'fr', 'translation' => 'abjurer'],
            ['word_id' => 8, 'language_code' => 'de', 'translation' => 'abschwören'],

            ['word_id' => 9, 'language_code' => 'tr', 'translation' => 'inkar etmek'],
            ['word_id' => 9, 'language_code' => 'fr', 'translation' => 'abnégation'],
            ['word_id' => 9, 'language_code' => 'de', 'translation' => 'abnegation'],
        ];

        foreach ($translations as $translation) {
            Translation::create($translation);
        }
    }
}
