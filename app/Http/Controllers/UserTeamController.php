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

    public function joinGroup(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'group_id' => 'required|exists:groups,id', // Ensure the group exists
        ]);

        $user = $request->user();

        // Check if user is a client
        if (!$user->userable || !($user->userable instanceof \App\Models\Client)) {
            return response()->json(['error' => 'User is not a client'], 403);
        }

        $client = $user->userable;

        // Check if the client is already part of the group
        if ($client->groups()->where('group_id', $request->group_id)->exists()) {
            return response()->json(['message' => 'You are already a member of this group'], 200);
        }

        try {
            // Attach the group to the client
            $client->groups()->attach($request->group_id, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return response()->json(['message' => 'Successfully joined the group!'], 200);
        } catch (\Exception $e) {
//            \Log::error('Error attaching group to client: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to join the group. Please try again.'], 500);
        }
    }

}
