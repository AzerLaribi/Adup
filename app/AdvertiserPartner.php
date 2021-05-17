<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class AdvertiserPartner extends Model
{
    use HasFactory;
    public $table = 'advertiser_partners';
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email', 
        'post', 
        'password',
        'location_name',
        'location_secteur',
        'location_region',
        'location_address',
        'location_tel',
        'email_pro',
        'website',
        'social_media',
        'logo',
        'status',
    ];
}
