<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed a user
        \App\Models\User::factory()->create([
            'name' => 'cyan',
            'email' => 'cyan.mv@gmail.com',
            'password' => bcrypt('toast'),
        ]);

        // Call other seeders here, including the ClientSeeder
        $this->call([
            ClientSeeder::class, // Calling ClientSeeder
            // You can add more seeders here if needed
            // TeamSeeder::class, etc.
        ]);
    }
}
