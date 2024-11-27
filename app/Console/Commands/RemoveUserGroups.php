<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class RemoveUserGroups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:remove-groups {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all groups from a specific user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get the email argument
        $email = $this->argument('email');

        // Find the user by email
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found.");
            return 1;
        }

        // Ensure the user is associated with a client
        $client = $user->userable;
        if (!$client || !$client instanceof \App\Models\Client) {
            $this->error("User with email {$email} is not associated with a client.");
            return 1;
        }

        // Detach all groups
        $client->groups()->detach();

        $this->info("All groups removed for user with email {$email}.");
        return 0;
    }
}
