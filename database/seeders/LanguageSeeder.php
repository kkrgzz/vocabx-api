<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Language;
use Illuminate\Support\Facades\File;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('seeders/languages.json'));
        $languages = json_decode($json, true);

        foreach ($languages as $language) {
            Language::create([
                'code' => $language['code'],
                'name' => $language['name'],
            ]);
        }
    }
}
