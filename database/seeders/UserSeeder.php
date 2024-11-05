<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        // Insert users into the database
        $users = [
            [
                'name' => 'cyan',
                'email' => 'cyan.mv@gmail.com',
                'password' => Hash::make('toast'), // Secure password hashing
            ],
            [
                'name' => 'venice',
                'email' => 'venice@gmail.com',
                'password' => Hash::make('toast'),
            ]
        ];

        // Use create() instead of insert() to return User models
        // Create users and attach them to teams

        // Populate team_user table
        foreach ($users as $userData) {
            $user = User::create($userData);

            // Conditional team attachment based on user email
            if ($user->email === 'cyan.mv@gmail.com') {
                $user->teams()->attach([1, 2]); // Attaches to teams with IDs 1 and 2
            } elseif ($user->email === 'venice@gmail.com') {
                $user->teams()->attach(3); // Attaches to team with ID 3 (or adjust as needed)
            }
        }
    }
}
