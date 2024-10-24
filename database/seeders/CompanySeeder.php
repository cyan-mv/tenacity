<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Team; // Import the Team model
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
        // Assuming you have at least one team, fetch a random team ID
        $team = Team::first(); // You can adjust this to fetch the appropriate team

        if ($team) {
            Company::create([
                'company_name' => 'Yum brands',
                'legal_name' => 'Yum brands legal name',
                'tax_id' => 'TAX-1234567',
                'phone' => '555-1234',
                'address' => '1234 Elm Street, Cityville',
                'email' => 'info@techsolutions.com',
                'website' => 'https://www.techsolutions.com',
                'city' => 'Cityville',
                'state' => 'Stateburg',
                'country' => 'USA',
                'status' => true, // true for active, false for inactive
                'logo' => 'https://via.placeholder.com/100x100.png?text=Tech+Solutions',
                'team_id' => 1, // Set the team ID
            ]);

            Company::create([
                'company_name' => 'Green Earth Corp.',
                'legal_name' => 'Green Earth Corporation',
                'tax_id' => 'TAX-7654321',
                'phone' => '555-5678',
                'address' => '789 Oak Street, Townsville',
                'email' => 'contact@greenearth.com',
                'website' => 'https://www.greenearth.com',
                'city' => 'Townsville',
                'state' => 'Stateburg',
                'country' => 'USA',
                'status' => false, // Inactive
                'logo' => 'https://via.placeholder.com/100x100.png?text=Green+Earth',
                'team_id' => 2, // Set the team ID
            ]);
        } else {
            // Handle case where no teams exist, if necessary
            $this->command->warn('No teams found. Please seed the teams table first.');
        }
    }
}
