<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Character;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            Character::factory(3)->create([
                'enemy' => false,
                'user_id' => $user->id,
            ]);
        }

        Character::factory(3)->create([
            'enemy' => true,
            'user_id' => 1,
        ]);

    }
}
