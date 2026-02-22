<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'address',
        'longitude',
        'latitude',
        'logo',
        'contact_number',
        'contact_email',
        'contact_name',
        'society_type',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function getSocietyTypeLabelAttribute()
    {
        return $this->society_type?->getLabel();
    }
}
