<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Filament\Facades\Filament;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Get the authenticated user
        $user_tenants = $user->getTenants(new \Filament\Panel()); // Get tenants (teams)
        $user_teams = $user->teams()->get(); // This will retrieve the user's teams.
        $canAccessTenant = $user->canAccessTenant($user_tenants->first()); // Check tenant access
        $canAccessPanel = $user->canAccessPanel(new \Filament\Panel()); // Check if user can access the panel
        $teams = Team::all(); // Find the team by its ID

//        $panelId = Filament::getCurrentPanel()?->getId(); // Get the current panel's ID
//        $panelName = Filament::getCurrentPanel()?->getLabel(); // Get the current panel's label/name
        $panelName = Filament::getCurrentPanel()->getId();
        // Pass the $first_team variable to the view
        return view('welcome', compact('user', 'user_tenants','user_teams', 'canAccessTenant', 'canAccessPanel', 'teams', 'panelName'));
    }



}
