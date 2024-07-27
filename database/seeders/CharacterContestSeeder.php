<?php

namespace Database\Seeders;

use App\Models\Contest;
use App\Models\Character;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CharacterContestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $contests = Contest::all();

        foreach ($contests as $contest) {

            //random nem ellenfél karakter kiválasztása
            $character = Character::where('enemy', false)
                                  ->inRandomOrder()
                                  ->first();
                                  
            //ellenfél karakter kiválasztása
            $enemy = Character::where('enemy', true)
                              ->inRandomOrder()
                              ->first();

            $contest->characters()->attach($character->id, [
                'enemy_id' => $enemy->id,
                'character_hp' => 20,
                'enemy_hp' => 20,
            ]);
            // $contest->characters()->attach($character->id, ['is_enemy' => false, 'hp' => 20]);
            // $contest->characters()->attach($enemy->id, ['is_enemy' => true, 'hp' => 20]);
        }
    }
}
