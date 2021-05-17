<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Location extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    public $table = 'locations';

    protected $appends = [
        'photos',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'address',
        'region',
        'tags',
        'type',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function rasbarys()
    {
        return $this->belongsToMany(Rasbary::class);
    }
    public function tags()
    {
        return $this->belongsToMany(tags::class);
    }
    public function typs()
    {
        return $this->belongsToMany(type::class);
    }

    public function ads()
    {
        return $this->belongsToMany(Ads::class);
    }
    public function locationPartner()
    {
        return $this->belongsToMany(locationPartner::class);
    }

}
