<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Team; // Import the Team model
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        // Create a company without assigning a team_id
        Company::create([
            'company_name' => 'Yum brands',
            'legal_name' => 'Yum brands legal name',
            'tax_id' => 'TAX-1234567',
            'phone' => '555-1234',
            'address' => '1234 Elm Street, Cityville',
            'email' => 'info@yumbrands.com',
            'website' => 'https://www.yumbrands.com',
            'city' => 'Cityville',
            'state' => 'Stateburg',
            'country' => 'USA',
            'status' => true,
            'logo' => 'https://s3-symbol-logo.tradingview.com/yum-brands--600.png',
            // Leave team_id out for now
        ]);
        Company::create([
            'company_name' => 'Darden Eats',
            'legal_name' => 'Darden Dining Corp',
            'tax_id' => 'TAX-4567890',
            'phone' => '555-7890',
            'address' => '789 Culinary Road, Flavor Town',
            'email' => 'contact@dardeneats.com',
            'website' => 'https://www.dardeneats.com',
            'city' => 'Flavor Town',
            'state' => 'Taste State',
            'country' => 'USA',
            'status' => true,
            'logo' => 'https://pbs.twimg.com/profile_images/798611031903891460/shVVWbz3_400x400.jpg',
            // Leave team_id out for now
        ]);


    }
}
