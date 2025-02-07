<?php

namespace Database\Seeders;

use App\Models\Sentence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SentenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sentences = [
            ['word_id' => 1, 'sentence' => 'He abandoned his car on the roadside.'],
            ['word_id' => 1, 'sentence' => 'The project was abandoned due to lack of funds.'],

            ['word_id' => 2, 'sentence' => 'The noise abated after midnight.'],
            ['word_id' => 2, 'sentence' => 'Measures were taken to abate pollution levels.'],

            ['word_id' => 3, 'sentence' => 'The king abdicated the throne to live a quiet life.'],
            ['word_id' => 3, 'sentence' => 'She refused to abdicate her duty to protect the team.'],

            ['word_id' => 4, 'sentence' => 'The sudden heatwave in winter was an aberration.'],
            ['word_id' => 4, 'sentence' => 'His kindness was an aberration in a family known for cruelty.'],

            ['word_id' => 5, 'sentence' => 'She abhors cruelty to animals.'],
            ['word_id' => 5, 'sentence' => 'He abhors the idea of cheating to succeed.'],

            ['word_id' => 6, 'sentence' => 'You must abide by the rules of the competition.'],
            ['word_id' => 6, 'sentence' => 'I cannot abide people who talk during movies.'],

            ['word_id' => 7, 'sentence' => 'They survived in abject poverty for years.'],
            ['word_id' => 7, 'sentence' => 'The apology was met with abject silence.'],

            ['word_id' => 8, 'sentence' => 'The activist abjured violence in her speeches.'],
            ['word_id' => 8, 'sentence' => 'He abjured his citizenship to live abroad.'],

            ['word_id' => 9, 'sentence' => 'Her abnegation of fame surprised everyone.'],
            ['word_id' => 9, 'sentence' => 'Monastic life requires strict abnegation of worldly desires.'],

            ['word_id' => 10, 'sentence' => 'The abominable crime shocked the nation.'],
            ['word_id' => 10, 'sentence' => 'They endured abominable conditions during the expedition.'],
        ];

        foreach ($sentences as $sentence) {
            Sentence::create($sentence);
        }
    }
}
