<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Define the relationship with the User model
    public function members()
    {
        return $this->belongsToMany(User::class, 'team_user', 'team_id', 'user_id');
    }

    public function branches()
    {
        return $this->hasMany(Branch::class, 'team_id');
    }

    // Define the relationship with the Client model
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    // Define the relationship with the Company model
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
