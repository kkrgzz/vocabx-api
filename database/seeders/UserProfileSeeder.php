<?php

namespace Database\Seeders;

use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserProfile::factory()->create([
            'user_id' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'mother_language' => 'tr',
            'target_language' => 'en',
        ]);
    }
}
