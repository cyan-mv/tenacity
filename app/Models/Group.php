<?php

namespace App\Models;

use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Model;

class Group extends Model implements HasName
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

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id')->withTimestamps();
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id')->withTimestamps();
    }

    // Implement the getFilamentName method
    public function getFilamentName(): string
    {
        return $this->description; // Use 'description' as the name
    }



}
