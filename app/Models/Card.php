<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'card_number',
        'group_id',
        'team_id', // Include this field
    ];

    // A card belongs to a group
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    // A card belongs to a team
//    public function team()
//    {
//        return $this->belongsTo(Team::class);
//    }

    // In Card.php (Model)
    public function getTeamsAttribute()
    {
        return $this->group->teams; // This assumes each card belongs to a group
    }

}
