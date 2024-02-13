<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(7)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'role' => 1,
        ]);
        User::factory()->create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => Hash::make('user'),
            'role' => 1,
        ]);
        User::factory()->create([
            'name' => 'user2',
            'email' => 'user2@user.com',
            'password' => Hash::make('user2'),
            'role' => 1,
        ]);

        $this->call(CategorySeeder::class);
        $this->call(TagSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
