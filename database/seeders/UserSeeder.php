<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Admin;
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
        // Define users and their relationships
        $users = [
            [
                'name' => 'cyan',
                'email' => 'cyan.mv@gmail.com',
                'password' => Hash::make('toast'),
                'admin' => [
                    'role' => 'admin', // Role for the admin
                ],
                'client' => null, // No client relationship for this user
                'teams' => [1, 2],
            ],
            [
                'name' => 'venice',
                'email' => 'venice@gmail.com',
                'password' => Hash::make('toast'),
                'admin' => [
                    'role' => 'admin', // Role for the admin
                ],
                'client' => null,
                'teams' => [3],
            ],
            [
                'name' => 'clementine',
                'email' => 'clementine@gmail.com',
                'password' => Hash::make('toast'),
                'client' => [
                    'name' => 'clementine', // Explicitly set
                    'email' => 'clementine@gmail.com', // Explicitly set
                    'teams' => [1, 2, 3], // Teams assigned to the client
                ],
            ],
            [
                'name' => 'Jenna User',
                'email' => 'jenna@gmail.com',
                'password' => Hash::make('toast'),
                'client' => [
                    'name' => null, // Dynamically fill later
                    'email' => null, // Dynamically fill later
                    'teams' => [1], // Teams assigned to the client
                ],
            ],
            [
                'name' => 'Emma User',
                'email' => 'emma@gmail.com',
                'password' => Hash::make('toast'),
                'client' => [
                    'name' => null, // Dynamically fill later
                    'email' => null, // Dynamically fill later
                    'teams' => [2], // Teams assigned to the client
                ],
            ],
        ];

        foreach ($users as $userData) {
            // Extract and unset admin, client, and teams data before creating the user
            $adminData = $userData['admin'] ?? null;
            $clientData = $userData['client'] ?? null;
            $userTeams = $userData['teams'] ?? [];
            unset($userData['admin'], $userData['client'], $userData['teams']);

            // Create the user
            $user = User::create($userData);

            // Handle the admin relationship
            if ($adminData) {
                // Create admin and associate
                $admin = Admin::create($adminData);
                $user->userable()->associate($admin);
                $user->save();
            }

            // Handle the client relationship
            if ($clientData) {
                // Extract teams for the client
                $clientTeams = $clientData['teams'] ?? [];
                unset($clientData['teams']);

                // Dynamically assign client name and email if null
                $clientData['name'] = $clientData['name'] ?? $userData['name'];
                $clientData['email'] = $clientData['email'] ?? $userData['email'];

                // Create client and associate
                $client = Client::create($clientData);
                $user->userable()->associate($client);
                $user->save();

                // Attach teams to the client
                if (!empty($clientTeams)) {
                    $client->teams()->sync($clientTeams);
                }
            }

            // Attach teams to the user
            if (!empty($userTeams)) {
                $user->teams()->sync($userTeams);
            }
        }
    }
}
