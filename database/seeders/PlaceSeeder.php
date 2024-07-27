<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = range(1, 5);

        foreach ($images as $image) {
            Place::factory()->create([
                'image' => $image,
            ]);
        }
    }
}
