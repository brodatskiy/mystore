<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Size;
use App\Models\Sticker;
use App\Models\Tag;
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
        $tags = Tag::all();
        $sizes = Size::all();


        Product::factory()
            ->count(24)
            ->hasAttached($tags
                ->random(2))
            ->hasAttached(
                $sizes,
                ['count' => 10]
            )
            ->create();
    }
}
