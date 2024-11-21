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
            'image' => 'groups/vip-group.png', // Example image path
        ]);


        // Retrieve multiple teams to associate with this group
        $teams = Team::take(2)->get(); // Fetch the first 2 teams, adjust as needed

        if ($teams->isNotEmpty()) {
            // Attach the teams to the group
            $group->teams()->attach($teams->pluck('id'));
        } else {
            // Handle the case where no teams are found
            $this->command->info('No teams found. Please seed the Team table first.');
        }
    }
}
