<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Contest;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContestController extends Controller
{
    public function count()
    {
        return Contest::count();
    }

    public function contests($id)
    {
        $character = Character::findOrFail($id);
        $contests = $character->contests()->get();

        return $contests;
    }

    public function store(Request $request, Character $character)
    {

        
        $enemy = Character::where('enemy', true)
        ->inRandomOrder()
        ->first();
        
        $placeId = Place::inRandomOrder()
        ->first()
        ->id;

        $contestData = [
            'win' => false,
            'history' => "",
            'place_id' => $placeId,
        ];
        
        $contest = Contest::create($contestData);
        
        $contest->characters()->attach($character->id, [
            'enemy_id' => $enemy->id,
            'character_hp' => 20,
            'enemy_hp' => 20,
        ]);

        return redirect("/character/{$character->id}");
    }

    public function show(Contest $contest, Character $character)
    {
        return view('contest', ['contest' => $contest, 'character' => $character, 'enemy'=> $contest->getEnemy($contest->id)]);
    }

    public function attack(Contest $contest, $attackType,Character $character)
    {
        $enemyHp = $contest->getEnemyHp($contest->id);
        switch ($attackType) {
            case 'melee':
                $enemyHp -= ($character->strength * 0.7 + $character->accuracy * 0.1 + $character->magic * 0.1) - 3;
                break;
            case 'ranged':
                $enemyHp -= ($character->strength * 0.1 + $character->accuracy * 0.7 + $character->magic * 0.1) - 3;
                break;
            case 'special':
                $enemyHp -= ($character->strength * 0.1 + $character->accuracy * 0.1 + $character->magic * 0.7) - 3;
                break;
        }

        $characterHp = $contest->getCharacterHp($contest->id);
        if( $characterHp > 4){
            $contest->updateCharacterHp($contest->id, $characterHp-4);
        } else {
            $contest->updateCharacterHp($contest->id, 0);
        }


        if($enemyHp > 0) {
            $contest->updateEnemyHp($contest->id, $enemyHp);
        } else {
            $contest->updateEnemyHp($contest->id, 0);
        }

        return redirect("/contests/{$contest->id}/{$character->id}");
    }
}
