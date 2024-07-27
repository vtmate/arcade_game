<?php

namespace Database\Seeders;

use App\Models\Place;
use App\Models\Contest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $places = Place::all();
        foreach ($places as $place) {
            Contest::factory(10)->create([
                'place_id' => $place->id,
            ]);
        }
    }
}
