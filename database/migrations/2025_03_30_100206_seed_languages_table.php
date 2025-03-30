<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $jsonPath = resource_path('data/languages.json');
        if (File::exists($jsonPath)) {
            $languages = json_decode(File::get($jsonPath), true);
            if (is_array($languages)) {
                foreach ($languages as $index => $language) {
                    DB::table('languages')->insert([
                        'code'       => $language['code'],
                        'name'       => $language['name'],
                        'sort_order' => $index, // preserve order from JSON
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('languages')->truncate();
    }
};
