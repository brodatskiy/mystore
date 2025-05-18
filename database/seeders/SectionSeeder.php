<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::factory()->hasCategories(7)->create(['title' => function () {
            return 'Clothing';
        }]);
        Section::factory()->hasCategories(7)->create(['title' => function () {
            return 'Shoe';
        }]);

        Section::factory()->hasCategories(7)->create(['title' => function () {
            return 'Accessories';
        }]);

    }
}
