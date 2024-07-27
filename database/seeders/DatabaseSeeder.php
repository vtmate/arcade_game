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

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'q@q.hu',
            'admin' => true,
        ]);

        User::factory(10)->create();

        $this->call([
            CharacterSeeder::class,
            PlaceSeeder::class,
            ContestSeeder::class,
            CharacterContestSeeder::class,
        ]);
    }
}