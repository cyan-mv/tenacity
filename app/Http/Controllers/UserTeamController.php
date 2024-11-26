<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class UserTeamController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Ensure userable exists and is a Client
        $teams = $user->userable && $user->userable instanceof \App\Models\Client
            ? $user->userable->teams
            : [];

        // Fetch groups associated with the user (client-specific groups)
        $userGroups = $user->userable && $user->userable instanceof \App\Models\Client
            ? $user->userable->groups
            : collect(); // Return an empty collection if no groups

        // Fetch all available groups (for the "Available Groups" section)
        $availableGroups = \App\Models\Group::all();

        return Inertia::render('Profile/UserTeams', [
            'user' => $user,
            'teams' => $teams,
            'userGroups' => $userGroups,
            'availableGroups' => $availableGroups,
        ]);
    }
}
