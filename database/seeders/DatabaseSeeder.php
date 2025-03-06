<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'email' => 'test@kkaragoz.com',
        //     'password' => 'password',
        // ]);

        //call language seeder
        $this->call(UserSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(WordSeeder::class);
        $this->call(TranslationSeeder::class);
        $this->call(SentenceSeeder::class);
    }
}
