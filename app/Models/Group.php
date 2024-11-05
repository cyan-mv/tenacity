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
        'company_id',
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

}
