<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CharacterController;


Route::get('/', function () {
    $characterCount = app(CharacterController::class)->count();
    $contestCount = app(ContestController::class)->count();
    
    return view('home', ['characterCount' => $characterCount, 'contestCount' => $contestCount]);
});

Route::get('/characters', function () {
    $characters = app(CharacterController::class)->characters();
    
    return view('characterslist', ['characters' => $characters]);
});

Route::get('/character/{id}', function (Request $request, string $id) {
    $character= app(CharacterController::class)->getCharacterById($id);
    $contests= app(ContestController::class)->contests($id);

    return view('character', ['character' => $character, 'contests' => $contests]);
});

Route::get('/character/{id}/edit', function (Request $request, string $id) {
    $character= app(CharacterController::class)->getCharacterById($id);

    return view('characteredit', ['character' => $character]);
});

Route::get('/create', function () {
    return view('charactercreate');
});


Route::middleware('auth')->group(function () {
    Route::delete('/characters/{id}', [CharacterController::class, 'destroy'])->name('characters.destroy');
    Route::patch('/characters/{id}', [CharacterController::class, 'update'])->name('characters.update');
    Route::post('/characters', [CharacterController::class, 'store'])->name('characters.store');

    Route::post('/characters/{character}', [ContestController::class, 'store'])->name('contests.store');
    Route::get('/contests/{contest}/{character}', [ContestController::class, 'show'])->name('contests.show');
});

Route::get('/places', function () {
    $places = app(PlaceController::class)->places();
    
    return view('places', ['places' => $places]);
});

Route::post('/upload-image', [ImageController::class, 'upload'])->name('upload.image');
Route::delete('/places/{id}', [ImageController::class, 'destroy'])->name('places.destroy');
Route::patch('/places/{id}', [PlaceController::class, 'update'])->name('places.update');

Route::get('/place/{id}/edit', function (Request $request, string $id) {
    $place= app(PlaceController::class)->getPlaceById($id);

    return view('placeedit', ['place' => $place]);
});

Route::get('/contest/{contest}/attack/{attackType}/{character}', [ContestController::class, 'attack'])->name('contest.attack');

Route::get('/dashboard', function () {
    $characters = app(CharacterController::class)->characters();
    return view('characterslist', ['characters' => $characters]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
