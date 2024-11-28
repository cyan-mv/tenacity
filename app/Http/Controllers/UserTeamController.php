<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log; // Add this line

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
//        $userGroups = $user->userable && $user->userable instanceof \App\Models\Client
//            ? $user->userable->groups
//            : collect(); // Return an empty collection if no groups
        $userGroups = $user->userable && $user->userable instanceof \App\Models\Client
            ? $user->userable->groups()->withPivot('card_number')->get()
            : collect();


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
        $request->validate([
            'group_id' => 'required|exists:groups,id',
        ]);

        $user = $request->user();

        if (!$user->userable || !($user->userable instanceof \App\Models\Client)) {
//            \Log::error('User is not a client');
            return response()->json(['error' => 'User is not a client'], 403);
        }

        $client = $user->userable;

        if ($client->groups()->where('group_id', $request->group_id)->exists()) {
//            \Log::info('Client already belongs to the group.');
            return response()->json(['message' => 'You are already a member of this group'], 200);
        }

        try {
            $group = \App\Models\Group::findOrFail($request->group_id);
            $cardNumber = $group->generateNextCardNumber();

//            \Log::info("Generated Card Number: {$cardNumber}");

            $client->groups()->attach($group->id, [
                'card_number' => $cardNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

//            \Log::info("Successfully attached client {$client->id} to group {$group->id}.");

            return response()->json([
                'message' => 'Successfully joined the group!',
                'card_number' => $cardNumber,
            ], 200);
        } catch (\Exception $e) {
//            \Log::error('Error attaching group to client: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to join the group. Please try again.'], 500);
        }
    }



}
