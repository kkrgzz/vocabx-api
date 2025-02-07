<?php

namespace Database\Seeders;

use App\Models\Word;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $words = [
            ['user_id' => 1, 'language_code' => 'en', 'word' => 'abandon'],
            ['user_id' => 1, 'language_code' => 'en', 'word' => 'abate'],
            ['user_id' => 1, 'language_code' => 'en', 'word' => 'abdicate'],
            ['user_id' => 1, 'language_code' => 'en', 'word' => 'aberration'],
            ['user_id' => 1, 'language_code' => 'en', 'word' => 'abhor'],
            ['user_id' => 1, 'language_code' => 'en', 'word' => 'abide'],
            ['user_id' => 1, 'language_code' => 'en', 'word' => 'abject'],
            ['user_id' => 1, 'language_code' => 'en', 'word' => 'abjure'],
            ['user_id' => 1, 'language_code' => 'en', 'word' => 'abnegation'],
            ['user_id' => 1, 'language_code' => 'en', 'word' => 'abominable'],
        ];

        foreach ($words as $word) {
            Word::factory()->create($word);
        }
    }
}
