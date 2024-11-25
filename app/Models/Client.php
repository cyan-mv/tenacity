<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Update the fillable property to exclude 'team_id'
    protected $fillable = ['name', 'email'];

    /**
     * Define a many-to-many relationship with the Team model.
     */
    public function team()
    {
        return $this->belongsToMany(Team::class, 'client_team', 'client_id', 'team_id')->limit(1);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'client_team', 'client_id', 'team_id');
    }



    /**
     * Define the polymorphic relationship with the User model.
     */
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'client_group', 'client_id', 'group_id')
//            ->withTimestamps()
            ;
    }
}
