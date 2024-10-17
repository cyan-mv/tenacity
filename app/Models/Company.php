<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;


    protected $fillable = [
        'company_name',
        'legal_name',
        'tax_id',
        'phone',
        'address',
        'email',
        'website',
        'city',
        'state',
        'country',
        'status',
        'logo'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    // One company manages many brands
//    public function brands()
//    {
//        return $this->hasMany(Brand::class, 'company_id');
//    }
//
//    // One company manages many branches
//    public function branches()
//    {
//        return $this->hasMany(Branch::class, 'company_id');
//    }
}
