<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    public function run()
    {
        // You can add as many teams as you like
        Team::create([
            'name' => 'KFC',
            'company_id' => 1
        ]);

        Team::create([
            'name' => 'Pizza hut',
            'company_id' => 1
        ]);

//        Team::create([
//            'name' => 'Team C',
//        ]);
    }
}
