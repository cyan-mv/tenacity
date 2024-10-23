<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Team;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed a user with specific id '1'
//        $user = User::factory()->create([
//            'id' => 1,  // Explicitly setting the ID to 1
//            'name' => 'cyan',
//            'email' => 'cyan.mv@gmail.com',
//            'password' => bcrypt('toast'),
//        ]);

        // Call other seeders here, ensuring TeamSeeder runs first
        $this->call([
            TeamSeeder::class,  // Ensure teams are seeded before clients
            ClientSeeder::class,
            CompanySeeder::class,
            UserSeeder::class,
            BranchSeeder::class,  // Add this line to call the BranchSeeder
        ]);

        // Ensure a team with id '1' is available
//        $team = Team::find(1);  // Retrieve the team with id '1'
//
//        // Check if the team exists before attaching
//        if ($team) {
//            // Attach the user with id '1' to the team with id '1'
//            $user->teams()->attach($team->id);
//        }
//        $user->teams()->attach(Team::find(2)->id);
    }
}
