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
        Tag::factory(10)->create();
    }
}
