<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Group;

class CardGenerator
{
    /**
     * Generate a specified number of cards for a group.
     *
     * @param Group $group The group for which cards are generated.
     * @param int $quantity The number of cards to generate.
     */
    public static function generateCards(Group $group, $quantity)
    {
        // Fetch the prefix, code, and consecutive length from the group
        $prefix = $group->prefix; // Example: '111'
        $code = $group->code; // Example: '001'
        $length = $group->consecutive_length; // Example: 5

        // Get the last card in this group to continue the sequence
        $lastCard = Card::where('group_id', $group->id)
            ->orderBy('id', 'desc')
            ->first();

        // Start the sequence from the last card or from 1 if none exist
        $startingPoint = $lastCard ? (int) substr($lastCard->card_number, -$length) + 1 : 1;

        // Generate the cards based on the quantity
        for ($i = $startingPoint; $i < $startingPoint + $quantity; $i++) {
            // Generate the card number: prefix + code + consecutive number
            $cardNumber = $prefix . str_pad($code, 3, '0', STR_PAD_LEFT) . str_pad($i, $length, '0', STR_PAD_LEFT);

            // Create the card in the database
            Card::create([
                'card_number' => $cardNumber,
                'group_id' => $group->id, // Assign the group_id to the card
            ]);
        }
    }
}
