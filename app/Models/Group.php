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


}
