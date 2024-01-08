<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->create(['title' => 'Sneakers']);
        Category::factory()->create(['title' => 'Boots']);
        Category::factory()->create(['title' => 'Shorts']);
        Category::factory()->create(['title' => 'Jeans']);
        Category::factory()->create(['title' => 'T-shirt']);
        Category::factory()->create(['title' => 'Hoodie']);
        Category::factory()->create(['title' => 'Sweatshirt']);
        Category::factory()->create(['title' => 'Hats']);
    }
}
