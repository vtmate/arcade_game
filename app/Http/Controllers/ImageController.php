<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Place;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $request->name . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        $place = new Place([
            'name' => $request->name,
            'image' => $request->name,
        ]);

        $place->save();

        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }

    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $imageName = $place->image;
        
        if (!$place) {
            return response()->json(['message' => 'Place not found'], 404);
        }

        $imagePath = public_path('images') . '\\' . $imageName . '.jpg';
        if (File::exists($imagePath)) {
            File::delete($imagePath);

            $place->delete();
            return redirect()->back()->with('success', 'Image uploaded successfully.');
        }
        return response()->json(['message' => 'noooooooooooo' . $imagePath], 200);
    }
}
