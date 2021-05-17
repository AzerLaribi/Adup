<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\User;
use App\Location;

class LocationPartner extends Model
{
    use HasFactory;
    public $table = 'location_partners';
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
        'location_name',
        'location_secteur',
        'location_region',
        'location_address',
        'location_tags',
        'location_tel',
        'email_pro',
        'website',
        'social_media',
        'logo',
        'status',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function locations()
    {
        return $this->belongsToMany(location::class);
    }
}
