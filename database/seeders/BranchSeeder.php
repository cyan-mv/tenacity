<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\Team;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure that teams exist before seeding branches
        $team = Team::first();  // Get the first team, or you can target a specific team if necessary

        // Check if at least one team exists before proceeding
        if ($team) {
            // Create multiple branches related to the first team
            Branch::create([
                'branch_name' => 'KFC Branch',
                'branch_phone' => '123-456-7890',
                'branch_address' => '123 Main St',
                'branch_city' => 'Example City',
                'branch_country' => 'CountryName',
                'branch_state' => 'StateName',
                'team_id' => $team->id,  // Assign this branch to the first team
            ]);

            // You can add more branches if needed
            Branch::create([
                'branch_name' => 'KFC Branch',
                'branch_phone' => '987-654-3210',
                'branch_address' => '456 Another St',
                'branch_city' => 'Another City',
                'branch_country' => 'CountryName',
                'branch_state' => 'StateName',
                'team_id' => $team->id,
            ]);

            Branch::create([
                'branch_name' => 'Pizza hut branch',
                'branch_phone' => '987-654-3210',
                'branch_address' => '456 Another St',
                'branch_city' => 'Another City',
                'branch_country' => 'CountryName',
                'branch_state' => 'StateName',
                'team_id' => 2,
            ]);
        } else {
            // Handle case where no team exists
            $this->command->info('No teams found. Please seed the Team model first.');
        }
    }
}
