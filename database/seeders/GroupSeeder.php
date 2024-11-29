<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;
use App\Models\Team;

class GroupSeeder extends Seeder
{
    public function run()
    {
        // Create a new group
        $group = Group::create([
            'code' => '001',
            'description' => 'VIP Group',
            'prefix' => '444',
            'status' => true,
           'consecutive_length' => 5,
            'color' => '#FF5733', // Example color
            'image' => 'KFC-logo.webp', // Example image path
        ]);

        // Create the second group and store it in $secondGroup
        $secondGroup = Group::create([
            'code' => '666',
            'description' => 'Silver Group',
            'prefix' => '777',
            'status' => true,
            'consecutive_length' => 5,
            'color' => '#FF5733', // Example color
            'image' => 'oliveGarden.jpg', // Example image path
        ]);

        // Retrieve multiple teams to associate with this group
        $teams = Team::take(2)->get(); // Fetch the first 2 teams, adjust as needed

        if ($teams->isNotEmpty()) {
            // Attach the teams to the first group (if needed)
            $secondGroup->teams()->attach($teams->pluck('id'));
        } else {
            // Handle the case where no teams are found
            $this->command->info('No teams found. Please seed the Team table first.');
        }

        // Attach the second group to the team with id=3
        $team = Team::find(3); // Find the team with id=3
        if ($team) {
            $secondGroup->teams()->attach($team->id); // Attach the second group to this team
            $this->command->info('Successfully attached the Silver Group to Team ID: 3.');
        } else {
            $this->command->info('Team with ID 3 not found. Please seed the Team table first.');
        }
    }
}
