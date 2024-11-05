<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        // Retrieve the first company created by CompanySeeder
        $company = Company::first();

        if ($company) {
            Team::create([
                'name' => 'KFC',
                'company_id' => $company->id,
            ]);

            Team::create([
                'name' => 'Pizza Hut',
                'company_id' => $company->id,
            ]);
        } else {
            $this->command->warn('No company found. Please seed the companies table first.');
        }

        Team::create(['name' => 'Olive Garden', 'company_id' => 2]);
    }
}
