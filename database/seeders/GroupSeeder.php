<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;
use App\Models\Company;

class GroupSeeder extends Seeder
{
    public function run()
    {
        $company = Company::first(); // Assuming you have at least one company

        if ($company) {
            Group::create([
                'code' => '001',
                'description' => 'VIP Group',
                'prefix' => '444',
                'status' => true,
                'consecutive_length' => 5,
                'company_id' => $company->id, // Link to the first company
            ]);
        } else {
            // Handle the case where no companies are found
            $this->command->info('No companies found. Please seed the Company table first.');
        }
    }
}
