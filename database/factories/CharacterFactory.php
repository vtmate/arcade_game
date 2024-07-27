<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $defence = fake()->numberBetween(0, 4);
        $strength = fake()->numberBetween(0, 21);
        $accuracy = fake()->numberBetween(0, 21);
        $magic = fake()->numberBetween(0, 21);

        $total = $defence + $strength + $accuracy + $magic;
        if ($total > 20) {
            $scalingFactor = 20 / $total;
            $defence = intval($defence * $scalingFactor);
            $strength = intval($strength * $scalingFactor);
            $accuracy = intval($accuracy * $scalingFactor);
            $magic = intval($magic * $scalingFactor);
        }

        return [
            'name' => fake()->name(),
            'defence' => $defence,
            'strength' => $strength,
            'accuracy' => $accuracy,
            'magic' => $magic,
        ];
    }
}
