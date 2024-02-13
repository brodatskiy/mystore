<?php

namespace Database\Seeders;

use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::factory()->create(['title' => 'New']);
        Tag::factory()->create(['title' => 'Bestseller']);
        Tag::factory()->create(['title' => 'Sale']);


        ProductTag::factory(10)->create();
    }
}
