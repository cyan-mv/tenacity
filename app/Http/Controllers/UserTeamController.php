<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class UserTeamController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Ensure userable exists and is a Client with teams
        $teams = $user->userable && $user->userable instanceof \App\Models\Client
            ? $user->userable->teams
            : [];

        // Fetch all groups (or limit them based on your needs)
        $groups = \App\Models\Group::all();

        return Inertia::render('Profile/UserTeams', [
            'user' => $user,
            'teams' => $teams,
            'groups' => $groups,
        ]);
    }
}
