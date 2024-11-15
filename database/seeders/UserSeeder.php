<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define users and their client relationships
        $users = [
            [
                'name' => 'cyan',
                'email' => 'cyan.mv@gmail.com',
                'password' => Hash::make('toast'),
                'client' => null, // No client relationship for this user
                'teams' => [1, 2], // Teams to attach
            ],
            [
                'name' => 'venice',
                'email' => 'venice@gmail.com',
                'password' => Hash::make('toast'),
                'client' => null,
                'teams' => [3],
            ],
            [
                'name' => 'agent',
                'email' => 'agent@gmail.com',
                'password' => Hash::make('toast'),
                'client' => [
                    'name' => 'agent',
                    'email' => 'agent@gmail.com',
                    'team_id' => 3, // Team for the client
                ],
                'teams' => [3],
            ],
        ];

        // Create users, attach clients, and set teams
        foreach ($users as $userData) {
            // Extract client data if present
            $clientData = $userData['client'];
            unset($userData['client'], $userData['teams']);

            // Create the user
            $user = User::create($userData);

            // Attach a client if defined
            if ($clientData) {
                $client = Client::create($clientData);
                $user->userable_id = $client->id;
                $user->userable_type = Client::class;
                $user->save();
            }

            // Attach teams
            if (isset($userData['teams'])) {
                $user->teams()->attach($userData['teams']);
            }
            // Conditional team attachment based on user email
            if ($user->email === 'cyan.mv@gmail.com') {
                $user->teams()->attach([1, 2]); // Attaches to teams with IDs 1 and 2
            } elseif ($user->email === 'venice@gmail.com') {
                $user->teams()->attach(3); // Attaches to team with ID 3 (or adjust as needed)
            }
        }
    }
}
