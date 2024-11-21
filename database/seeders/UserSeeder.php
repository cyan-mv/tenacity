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
                'client' => null,
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
                ],
                'teams' => [2],
            ],
        ];

        foreach ($users as $userData) {
            // Extract client data if present
            $clientData = $userData['client'];
            $teams = $userData['teams'];
            unset($userData['client'], $userData['teams']);

            // Create the user
            $user = User::create($userData);

            // Handle the client relationship
            if ($clientData) {
                $client = Client::create($clientData);
                $user->userable()->associate($client);
                $user->save();

                // Attach teams to the client
                $client->teams()->sync($teams);
            }

            // Attach teams to the user
            $user->teams()->sync($teams);
        }
    }
}
