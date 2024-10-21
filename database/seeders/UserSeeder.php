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
        foreach ($users as $userData) {
            $user = User::create($userData);

            // If the user email is cyan.mv@gmail.com, attach teams 1 and 2
            if ($user->email === 'cyan.mv@gmail.com') {
                $user->teams()->attach([1, 2]); // Assuming team IDs 1 and 2 exist
            }
        }
    }
}
