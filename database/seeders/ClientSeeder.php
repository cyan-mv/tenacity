<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Manually create clients with hardcoded data
        Client::create([
            'name' => 'Jenna',
            'email' => 'jenna@gmail.com',
            'team_id' => 1,
        ]);

        Client::create([
            'name' => 'Venice',
            'email' => 'venice@gmail.com',
            'team_id' => 1,
        ]);

        Client::create([
            'name' => 'Emma',
            'email' => 'emma@gmail.com',
            'team_id' => 2,
        ]);
    }
}
