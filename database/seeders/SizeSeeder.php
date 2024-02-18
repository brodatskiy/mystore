<?php

namespace Database\Seeders;

use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Size::factory()->create(['title' => 'xs']);
        Size::factory()->create(['title' => 's']);
        Size::factory()->create(['title' => 'm']);
        Size::factory()->create(['title' => 'l']);
        Size::factory()->create(['title' => 'xl']);
    }
}
