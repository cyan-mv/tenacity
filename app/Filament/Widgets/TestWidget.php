<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TestWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Get the first team that the user is part of (you may change this logic to suit your case)
        $team = auth()->user()->teams();
        $currentTeamId = auth()->user()->teams()->skip(0)->first()->id ?? null;


        // Check if a team is found, then count clients associated with that team
//        $clientCount = $team ? Client::where('team_id', $team->id)->count() : 0;

        return [
            Stat::make('clients', $currentTeamId),
        ];
    }
}
