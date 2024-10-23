<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_name',
        'branch_phone',
        'branch_address',
        'branch_city',
        'branch_country',
        'branch_state',
        'team_id',  // Use 'team_id' instead of 'company_id'
//        'brand_id'
    ];

    // A branch belongs to a brand
//    public function brand()
//    {
//        return $this->belongsTo(Team::class, 'brand_id');
//    }

    // A branch belongs to a team (instead of a company)
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
