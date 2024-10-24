<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'card_number',
        'group_id',
    ];

    // A card belongs to a group
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
