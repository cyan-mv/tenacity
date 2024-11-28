<?php

namespace App\Listeners;

use App\Events\ClientAddedToGroup;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AssignCardNumberToClient
{
    /**
     * Handle the event.
     *
     * @param ClientAddedToGroup $event
     * @return void
     */
    public function handle(ClientAddedToGroup $event)
    {
        $group = $event->group;
        $client = $event->client;

        // Generate the card number
        $cardNumber = $group->generateNextCardNumber();

        // Attach client to the group with the card number
        $group->clients()->attach($client->id, ['card_number' => $cardNumber]);
    }
}
