<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $languages = [
            ['name' => 'English', 'code' => 'en'],
            ['name' => 'Turkish', 'code' => 'tr'],
            ['name' => 'French', 'code' => 'fr'],
            ['name' => 'German', 'code' => 'de'],
        ];

        foreach ($languages as $language) {
            Language::create($language);
        }
    }
}
