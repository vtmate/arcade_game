<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\ImageController;

class PlaceController extends Controller
{
    public function places()
    {
        return Place::all();
    }

    public function getPlaceById($id)
    {
        $place = Place::findOrFail($id);
        // if ($place->user_id !== Auth::id()) {
        //     abort(403, 'Unauthorized');
        // }
        return $place;
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string',
        ]);

        $place = Place::find($id);
        
        if ($request->hasFile('image')) {
            // $image = $request->file('image');
            // $imageName = $request->name . '.' . $image->getClientOriginalExtension();
            // $image->move(public_path('images'), $imageName);

            $imageController = new ImageController();
            $imageController->destroy($id);
            $imageController->upload($request);
        } else {
            $place->update($validated);
        }

        return redirect('/places');
    }
}
