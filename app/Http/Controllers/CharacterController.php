<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Closure;

class CharacterController extends Controller
{
    public function count()
    {
        return Character::count();
    }

    public function characters()
    {
        $user = Auth::user();
        return $user->characters;
    }

    public function getCharacterById($id)
    {
        $character = Character::findOrFail($id);
        if ($character->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        return $character;
    }

    public function update(Request $request, $id)
    {
        $sum = $request->defence + $request->strength + $request->accuracy + $request->magic;
        $request->merge(['sum' => $sum]);
        
        $validated = $request->validate([
            'name' => 'required|string',
            'defence' => 'required|integer|min:0|max:20',
            'strength' => 'required|integer|min:0|max:20',
            'accuracy' => 'required|integer|min:0|max:20',
            'magic' => 'required|integer|min:0|max:20',
            'sum' => 'integer|max:20',
        ],[
            'sum.max' => 'A képességpontok összege nem haladhatja meg a 20-at'
        ]);

        $character = Character::find($id);

        $character->update($validated);

        return redirect("/character/{$id}");
    }

    public function store(Request $request)
    {
        $sum = $request->defence + $request->strength + $request->accuracy + $request->magic;
        $request->merge(['sum' => $sum]);
        
        $validated = $request->validate([
            'name' => 'required|string',
            'defence' => 'required|integer|min:0|max:20',
            'strength' => 'required|integer|min:0|max:20',
            'accuracy' => 'required|integer|min:0|max:20',
            'magic' => 'required|integer|min:0|max:20',
            'sum' => 'integer|max:20',
        ],[
            'sum.max' => 'A képességpontok összege nem haladhatja meg a 20-at'
        ]);

        $character = new Character();

        $character->user_id = Auth::user()->id;
        $character->name = $validated['name'];
        $character->defence = $validated['defence'];
        $character->strength = $validated['strength'];
        $character->accuracy = $validated['accuracy'];
        $character->magic = $validated['magic'];
        if (Auth::user()->admin && $request->enemy) {
            $character->enemy = true;
        } else {
            $character->enemy = false;
        }

        $character->save();

        // return view('character', ['character' => $character]);
        return redirect("/character/{$character->id}");
    }

    public function destroy($id)
    {
        $character = Character::findOrFail($id);
        $character->delete();

        return redirect('/characters');
    }

}
