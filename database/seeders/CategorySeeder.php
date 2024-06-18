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
        Category::factory()->create(['title' => 'Clothing']);
        Category::factory()->create(['title' => 'Shoes']);
        Category::factory()->create(['title' => 'Jewelry']);
        Category::factory()->create(['title' => 'Handbags']);
        Category::factory()->create(['title' => 'Hoodie']);
        Category::factory()->create(['title' => 'Sweatshirt']);
        Category::factory()->create(['title' => 'Hats']);
    }
}
