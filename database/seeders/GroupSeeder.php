<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;
use App\Models\Team;

class GroupSeeder extends Seeder
{
    public function run()
    {
        $team = Team::first(); // Assuming you have at least one team

        if ($team) {
            Group::create([
                'code' => '001',
                'description' => 'VIP Group',
                'prefix' => '444',
                'status' => true,
                'consecutive_length' => 5,
                'team_id' => $team->id, // Link to the first team
            ]);
        } else {
            // Handle the case where no teams are found
            $this->command->info('No teams found. Please seed the Team table first.');
        }
    }
}
