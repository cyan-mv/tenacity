<?php

namespace App\Events;

use App\Models\Client;
use App\Models\Group;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClientAddedToGroup
{
    use Dispatchable, SerializesModels;

    public $client;
    public $group;

    /**
     * Create a new event instance.
     *
     * @param Client $client
     * @param Group $group
     */
    public function __construct(Client $client, Group $group)
    {
        $this->client = $client;
        $this->group = $group;
    }
}
