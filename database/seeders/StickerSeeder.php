<?php

namespace Database\Seeders;

use App\Models\Sticker;
use Illuminate\Database\Seeder;

class StickerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sticker::factory()->create(['title' => 'New']);
        Sticker::factory()->create(['title' => 'Bestseller']);
        Sticker::factory()->create(['title' => 'Sale']);
    }
}
