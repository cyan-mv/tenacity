<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'code',
        'description',
        'prefix',
        'status',
        'consecutive_length',
        'color',
        'image',
    ];


    // Group belongs to a Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Optional: A helper method to generate the first card number
    public function generateCardNumber()
    {
        return $this->prefix . $this->code . str_pad(1, $this->consecutive_length, '0', STR_PAD_LEFT);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'group_team', 'group_id', 'team_id');
    }
//    public function team()
//    {
//        return $this->belongsTo(Team::class);
//    }
    public function team()
    {
        return $this->belongsToMany(Team::class, 'group_team', 'group_id', 'team_id')->limit(1);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_group', 'group_id', 'client_id')
//            ->withTimestamps()
            ;
    }

    public function generateNextCardNumber()
    {
        $this->current_sequence += 1;
        $this->save();

        return $this->prefix
            . $this->code
            . str_pad($this->current_sequence, $this->consecutive_length, '0', STR_PAD_LEFT);
    }

    public function addClientToGroup(Client $client)
    {
        // Check if the client is already in the group
        if ($this->clients()->where('client_id', $client->id)->exists()) {
            throw new \Exception("Client is already in this group.");
        }

        // Generate a card number
        $cardNumber = $this->generateNextCardNumber();

        // Save the client-group relationship and the card number
        $this->clients()->attach($client->id, ['card_number' => $cardNumber]);

        return $cardNumber;
    }

    public function getCardNumbers()
    {
        return $this->clients()->withPivot('card_number')->get()->pluck('pivot.card_number');
    }




}
