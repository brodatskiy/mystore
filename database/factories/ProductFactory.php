<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'content' => fake()->paragraph(3),
            'description' => fake()->paragraph(3),
            'category_id' => Category::all()->random()->id,
            'price' => fake()->numberBetween(1, 1000),
            'count' => fake()->numberBetween(1, 1000),
            'is_published' => 1
        ];
    }
}
