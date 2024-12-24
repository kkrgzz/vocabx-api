<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LanguageSeeder::class);

        User::create([
            'name'=> 'Kemal Karagöz',
            'email' => 'kemal@kkaragoz.com',
            'password' => Hash::make('password')
        ]);
    }
}
