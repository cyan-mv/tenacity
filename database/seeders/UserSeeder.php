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
                'teams' => [1, 2],
            ],
            [
                'name' => 'venice',
                'email' => 'venice@gmail.com',
                'password' => Hash::make('toast'),
                'client' => null,
                'teams' => [3],
            ],
            [
                'name' => 'clementine',
                'email' => 'clementine@gmail.com',
                'password' => Hash::make('toast'),
                'client' => [
                    'name' => 'clementine',
                    'email' => 'clementine@gmail.com',
                    'teams' => [1, 2, 3], // Clementine belongs to three teams
                ],
                'teams' => [1, 2, 3],
            ],
            [
                'name' => 'Jenna User',
                'email' => 'jenna@gmail.com',
                'password' => Hash::make('toast'),
                'client' => [
                    'name' => 'Jenna',
                    'email' => 'jenna@gmail.com',
                    'teams' => [1],
                ],
                'teams' => [1],
            ],
            [
                'name' => 'Emma User',
                'email' => 'emma@gmail.com',
                'password' => Hash::make('toast'),
                'client' => [
                    'name' => 'Emma',
                    'email' => 'emma@gmail.com',
                    'teams' => [2],
                ],
                'teams' => [2],
            ],
        ];

        // Create users, attach clients, and set teams
        foreach ($users as $userData) {
            // Extract client data if present
            $clientData = $userData['client'];
            $clientTeams = $clientData['teams'] ?? [];
            unset($clientData['teams'], $userData['client'], $userData['teams']);

            // Create the user
            $user = User::create($userData);

            // Attach a client if defined
            if ($clientData) {
                $client = Client::create($clientData);

                // Attach teams to the client
                if (!empty($clientTeams)) {
                    $client->teams()->attach($clientTeams);
                }

                // Associate the client with the user
                $user->userable_id = $client->id;
                $user->userable_type = Client::class;
                $user->save();
            }

            // Attach teams to the user
            if (!empty($userData['teams'])) {
                $user->teams()->attach($userData['teams']);
            }
            if ($user->email === 'cyan.mv@gmail.com') {
                $user->teams()->attach([1, 2]); // Attaches to teams with IDs 1 and 2
            } elseif ($user->email === 'venice@gmail.com') {
                $user->teams()->attach(3); // Attaches to team with ID 3 (or adjust as needed)
            }


        }
    }
}
