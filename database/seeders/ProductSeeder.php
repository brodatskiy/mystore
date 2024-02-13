<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(3)->create(['category_id' => 1, 'preview_image' => 'images/' . fake()->image('storage/app/public/images', 640, 480, 'sneakers', false)]);
        Product::factory(2)->create(['category_id' => 2, 'preview_image' => 'images/' . fake()->image('storage/app/public/images', 640, 480, 'boots', false)]);
        Product::factory(1)->create(['category_id' => 3, 'preview_image' => 'images/' . fake()->image('storage/app/public/images', 640, 480, 'shorts', false)]);
        Product::factory(4)->create(['category_id' => 4, 'preview_image' => 'images/' . fake()->image('storage/app/public/images', 640, 480, 'jeans', false)]);
        Product::factory(2)->create(['category_id' => 5, 'preview_image' => 'images/' . fake()->image('storage/app/public/images', 640, 480, 'shirts', false)]);
        Product::factory(2)->create(['category_id' => 6, 'preview_image' => 'images/' . fake()->image('storage/app/public/images', 640, 480, 'hoodies', false)]);
        Product::factory(1)->create(['category_id' => 7, 'preview_image' => 'images/' . fake()->image('storage/app/public/images', 640, 480, 'sweatshirts', false)]);
        Product::factory(2)->create(['category_id' => 8, 'preview_image' => 'images/' . fake()->image('storage/app/public/images', 640, 480, 'hats', false)]);
    }
}
