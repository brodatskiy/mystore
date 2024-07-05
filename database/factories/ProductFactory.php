<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sticker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
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
            'title' => fake()->words(1, true),
            'description' => fake()->paragraph(1),
            'preview_image' => fake()->imageUrl(300, 400),
            'color' => fake()->safeHexColor(),
            'category_id' => Category::all()->random()->id,
            'sticker_id' => Sticker::all()->random()->id,
            'price' => fake()->numberBetween(100, 1000),
            'is_published' => 1
        ];
    }
}
