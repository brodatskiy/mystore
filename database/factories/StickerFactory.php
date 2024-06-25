<?php

namespace Database\Factories;

use App\Models\Skicker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Skicker>
 */
class StickerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->word(),
        ];
    }
}
