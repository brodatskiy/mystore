<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::factory()->create(['title' => 'group 1']);
        Group::factory()->create(['title' => 'group 2']);
        Group::factory()->create(['title' => 'group 3']);
    }
}
